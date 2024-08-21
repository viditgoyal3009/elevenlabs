<?php

namespace Innovination\ElevenLabs;
use Illuminate\Support\Facades\Storage;

class ElevenLabs
{
    protected $api_key;
    
    public $voice_id, $text, $file_prefix, $path, $folder;

    public function __construct()
    {
        $this->api_key = env('XI_API_KEY');
        
    }

    public function generateAudio()
    {
        $api_key = $this->api_key;
        $voice_id = $this->voice_id;
        $text = $this->text;
        $file_prefix = isset($this->file_prefix) ? $this->file_prefix : 'audio';
        $folder = isset($this->path) ? $this->path : 'audio';
        $path = isset($this->path) ? $this->path . '/' .$file_prefix.'-'. uniqid() . '.mp3' : 'audio/' .$this->file_prefix.'-'. uniqid() . '.mp3';
        
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => "https://api.elevenlabs.io/v1/text-to-speech/".$voice_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                "model_id" => "eleven_monolingual_v1",
                "text" => $text,
                "voice_settings" => [
                    "similarity_boost" => 0.5,
                    "stability" => 0.5
                ]
            ]),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "xi-api-key: " . $api_key,
            ),
        ));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        //Check if directory exists, if not create it
        if (!file_exists(storage_path('app/public/' . $folder))) {
            mkdir(storage_path('app/public/' . $folder), 0777, true);
        }

        $localFilePath = storage_path('app/public/' . $path);
        file_put_contents($localFilePath, $response);

        //Check if file is downloaded locally
        if(file_exists($localFilePath)){
            // echo "File downloaded successfully at: " . $localFilePath;
        } else {
            // echo "Failed to download file at: " . $localFilePath;
        }

        //Then upload to Digital Ocean Spaces
        $fileContents = file_get_contents($localFilePath);
        $store = Storage::put($path, $fileContents, 'public');

        //Check if file is uploaded to Digital Ocean Spaces
        if($store){

            $disk = config('filesystems.default');
            if ($disk === 'spaces') {
                $storage_location = env('DO_SPACES_URL')."/".$path;
                unlink($localFilePath);
            }
            else if ($disk === 's3')
            {
                $storage_location = Storage::disk('s3')->url($path);
                unlink($localFilePath);
            }
            else {
                $storage_location = Storage::url($path);
            }

            $output = [
                'status' => 'success',
                'path' => $storage_location
            ];
        } 
        else {
            $output = [
                'status' => 'error',
                'message' => 'Failed to upload file'
            ];

        }   

        return $output;

    }
}

?>