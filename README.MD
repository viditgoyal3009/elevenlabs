# Text-to-Audio Composer Package

This Composer package allows you to convert text into audio using the ElevenLabs API.

## Installation

To install this package, you can use Composer. Run the following command in your project directory:

```
composer require innovination/elevenlabs
```

## Usage

To use this package, follow these steps:

1. Import the package into your PHP file:

```php
use Innovination\Elevenlabs;
```

2. Create an instance of the `Elevenlabs` class:

```php
$elevenlabs = new ElevenLabs();
```
3. Add ElevenLabs API key to your `.env` file

```php
XI_API_KEY='your-api-key'
```

4. Convert text to audio:

```php
//Required
$elevenlabs->voice_id = 'voice-id-on-elevenlabs';
$elevenlabs->text = "Hello, world!";
//Optional
$elevenlabs->file_prefix = "prefix"; // default is audio
$elevenlabs->path = "folder-name"; //default folder is audio
$audioFile = $elevenlabs->generateAudio($text);
```

The `generateAudio` method will return the path to the generated audio file along with `status` as `sucess` or `error`
