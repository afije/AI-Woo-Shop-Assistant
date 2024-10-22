<?php
class AI_Shop_Assistant_Image_Analysis {
    private $openai;

    public function __construct($openai) {
        $this->openai = $openai;
    }

    public function analyze_image($image_data) {
        // Remove the data URL prefix
        $image_data = preg_replace('/^data:image\/\w+;base64,/', '', $image_data);
        $image_data = base64_decode($image_data);

        // Save the image temporarily
        $temp_file = tempnam(sys_get_temp_dir(), 'ai_shop_assistant_');
        file_put_contents($temp_file, $image_data);

        // Analyze the image using OpenAI's API
        $analysis = $this->openai->analyze_image($temp_file);

        // Remove the temporary file
        unlink($temp_file);

        return $analysis;
    }

    public function extract_product_attributes($analysis) {
        // Extract relevant product attributes from the analysis
        $attributes = array();

        // Example attribute extraction (this should be adjusted based on the actual API response)
        if (preg_match('/color:\s*(\w+)/i', $analysis, $matches)) {
            $attributes['color'] = $matches[1];
        }
        if (preg_match('/type:\s*(\w+)/i', $analysis, $matches)) {
            $attributes['type'] = $matches[1];
        }
        // Add more attribute extractions as needed

        return $attributes;
    }
}
