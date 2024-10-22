<?php
class AI_Shop_Assistant_OpenAI {
    private $api_key;

    public function __construct($api_key) {
        $this->api_key = $api_key;
    }

    public function analyze_image($image_path) {
        $url = 'https://api.openai.com/v1/chat/completions';

        $image_data = base64_encode(file_get_contents($image_path));

        $data = array(
            'model' => 'gpt-4-vision-preview',
            'messages' => array(
                array(
                    'role' => 'user',
                    'content' => array(
                        array(
                            'type' => 'text',
                            'text' => 'Analyze this image and describe the main product visible, including its type, color, and any other relevant attributes.'
                        ),
                        array(
                            'type' => 'image_url',
                            'image_url' => array(
                                'url' => "data:image/jpeg;base64,{$image_data}"
                            )
                        )
                    )
                )
            ),
            'max_tokens' => 300
        );

        $response = $this->call_openai_api($url, $data);

        if ($response && isset($response['choices'][0]['message']['content'])) {
            return $response['choices'][0]['message']['content'];
        }

        return false;
    }

    private function call_openai_api($url, $data) {
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $this->api_key,
                'Content-Type' => 'application/json'
            ),
            'body' => json_encode($data),
            'method' => 'POST',
            'data_format' => 'body',
            'timeout' => 45  // Increased timeout for image processing
        );

        $response = wp_remote_post($url, $args);

        if (is_wp_error($response)) {
            return false;
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }
}
