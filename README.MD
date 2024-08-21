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

2. Create an instance of the `TextToAudio` class:

```php
$textToAudio = new TextToAudio();
```

3. Convert text to audio:

```php
$text = "Hello, world!";
$audioFile = $textToAudio->convert($text);
```

The `convert` method will return the path to the generated audio file.

4. Play the audio file:

You can use any audio player of your choice to play the generated audio file.
