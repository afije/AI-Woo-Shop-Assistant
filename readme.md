# AI Shop Assistant for WooCommerce

AI Shop Assistant is a WordPress plugin that enhances your WooCommerce store with AI-powered product recognition and suggestions. It uses image analysis to provide real-time product recommendations to your customers, creating a more interactive and personalized shopping experience.

## Features

- Real-time image analysis using OpenAI's GPT-4 Vision API
- Automatic product suggestions based on image content
- Customizable shop assistant button
- Easy integration with existing WooCommerce stores
- Admin dashboard for plugin configuration

## Requirements

- WordPress 5.0 or higher
- WooCommerce 3.0 or higher
- PHP 7.2 or higher
- OpenAI API key

## Installation

1. Download the `ai-shop-assistant.zip` file from the latest release.
2. Log in to your WordPress admin panel and navigate to Plugins > Add New.
3. Click on the "Upload Plugin" button and select the downloaded zip file.
4. Click "Install Now" and then "Activate" to enable the plugin.

## Configuration

1. After activation, go to Settings > AI Shop Assistant in your WordPress admin panel.
2. Enter your OpenAI API key in the provided field.
3. Customize the shop assistant button text and position as desired.
4. Save your settings.

## Usage

Once configured, the AI Shop Assistant button will appear on your WooCommerce store's frontend. When a customer clicks the button:

1. The plugin will access the customer's camera (with permission).
2. It will capture images at regular intervals.
3. The images are sent to the OpenAI API for analysis.
4. Based on the analysis, relevant products from your WooCommerce store are suggested to the customer.
5. Customers can easily add suggested products to their cart.

## Development

To set up the development environment:

1. Clone this repository to your local machine.
2. Navigate to your WordPress plugins directory.
3. Create a symlink to the cloned repository:
   ```
   ln -s /path/to/cloned/repo ai-shop-assistant
   ```
4. Activate the plugin in WordPress.

### File Structure

- `ai-shop-assistant.php`: Main plugin file
- `includes/`: Core plugin classes
- `admin/`: Admin-related files
- `public/`: Public-facing functionality
- `languages/`: Internationalization files

## Contributing

We welcome contributions to the AI Shop Assistant plugin! Please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and commit them with clear, descriptive messages.
4. Push your changes to your fork.
5. Submit a pull request to the main repository.

Please ensure your code adheres to the WordPress Coding Standards and is properly documented.

## License

This project is licensed under the GPL v2 or later.

## Support

For support, please open an issue on the GitHub repository or contact us through our website.

## Acknowledgements

- This plugin uses the OpenAI GPT-4 Vision API for image analysis.
- Built for integration with WooCommerce, the most popular e-commerce platform for WordPress.

---

Thank you for using or contributing to AI Shop Assistant for WooCommerce!
