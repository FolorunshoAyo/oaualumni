<?php

namespace App\Controllers;

class SendGridEmailController extends BaseController
{
    protected $helpers = ['custom_helper'];

    /**
     * Send an email with varying information.
     *
     * @param string $apiKey The SendGrid API key.
     * @param string $fromEmail The sender's email address.
     * @param string $fromName The sender's name.
     * @param string $subject The subject of the email.
     * @param array $to An array of recipient email addresses.
     * @param array $cc An optional array of CC email addresses.
     * @param string $plainTextContent The plain text content of the email.
     * @param string $htmlContent The HTML content of the email.
     *
     * @return void
     */
    public function sendEmail(
        string $subject,
        array $to,
        array $cc = [],
        string $plainTextContent = '',
        string $htmlContent = ''
    ) {
        // URL to send the request to
        $url = 'https://api.sendgrid.com/v3/mail/send';
        $apiKey = getenv('SENDGRID_API_KEY');
        $fromEmail = "support@greatifealumnidmv.org";
        $fromName = "Great Ife Alumni";

        // Prepare the data to send
        $data = [
            'personalizations' => [
                [
                    'to' => array_map(function ($email) {
                        return ['email' => $email];
                    }, $to),
                    'subject' => $subject
                ]
            ],
            'from' => [
                'email' => $fromEmail,
                'name' => $fromName
            ],
            'content' => array_filter([
                $plainTextContent ? ['type' => 'text/plain', 'value' => $plainTextContent] : null,
                $htmlContent ? ['type' => 'text/html', 'value' => $htmlContent] : null
            ])
        ];

        // Include CC only if provided and non-empty
        if (!empty($cc)) {
            $data['personalizations'][0]['cc'] =  array_map(function ($email) {
                return ['email' => $email];
            }, $cc);
        }

        // Ensure content is an array
        $data['content'] = array_values($data['content']);

        // Headers for the request
        $headers = [
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ];

        // Make the request
        $response = make_curl_request($url, 'POST', $data, $headers);

        $response = json_decode($response, true);

        
        // Output the response
        if(isset($response['errors'])){
            return false;
        }else{
            return true;
        }
    }
}
