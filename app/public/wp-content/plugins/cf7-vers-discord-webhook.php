<?php
/*
Plugin Name: CF7 to Discord Webhook
Plugin URI: https://example.com
Description: Envoie les soumissions de Contact Form 7 vers un webhook Discord.
Version: 1.0
Author: thomas
License: GPL2
*/

// Sécuriser le plugin contre un accès direct
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Fonction pour envoyer les données au webhook Discord
function cf7_to_discord_webhook( $contact_form ) {
    // Vérifiez si le formulaire est soumis
    $form_id = $contact_form->id();
    $webhook_url = 'https://discord.com/api/webhooks/1306238434209173515/sd0bv1H-5_oRDfgbv8v9vkTsNEcEOPW-EpZAfX1MpQum93PV4-JUwexRyyzLMfrZx0qg'; // Remplacez par votre URL de webhook Discord
    // Récupérer l'instance de soumission de Contact Form 7
    $submission = WPCF7_Submission::get_instance();
    
    // Si une soumission existe
    if ( $submission ) {
        // Récupérer les données soumises
        $fields = $submission->get_posted_data();

        // Structurer le message JSON pour Discord
        $message = array(
            'username' => 'Formulaire Contact',
            'avatar_url' => 'https://example.com/avatar.png', // URL de l'avatar
            'embeds' => array(
                array(
                    'title' => 'Nouveau message reçu',
                    'color' => 5620992, // Couleur de l'embed (hex)
                    'fields' => array(
                        array(
                            'name' => 'Nom',
                            'value' => isset( $fields['your-name'] ) ? $fields['your-name'] : 'Non spécifié',
                            'inline' => true,
                        ),
                        array(
                            'name' => 'Email',
                            'value' => isset( $fields['your-email'] ) ? $fields['your-email'] : 'Non spécifié',
                            'inline' => true,
                        ),
                        array(
                            'name' => 'Message',
                            'value' => isset( $fields['your-message'] ) ? $fields['your-message'] : 'Non spécifié',
                            'inline' => false,
                        ),
                    ),
                    'footer' => array(
                        'text' => 'Formulaire Contact '
                    ),
                    'timestamp' => date( 'c' ), // Horodatage de l'envoi
                ),
            ),
        );

        // Convertir le message en JSON
        $json_data = json_encode( $message );

        // Utiliser wp_remote_post pour envoyer la requête
        $response = wp_remote_post( $webhook_url, array(
            'method'    => 'POST',
            'body'      => $json_data,
            'headers'   => array( 'Content-Type' => 'application/json' ),
        ) );

        // Vérifiez si la requête a réussi
        if ( is_wp_error( $response ) ) {
            error_log( 'Erreur lors de l\'envoi du message à Discord.' );
        } else {
            // Optionnel : Enregistrez la réponse ou effectuez une action supplémentaire
            error_log( 'Message envoyé à Discord avec succès.' );
        }
    }
}

// Attachez la fonction au hook de Contact Form 7 pour l'exécution après la soumission
add_action( 'wpcf7_mail_sent', 'cf7_to_discord_webhook' );