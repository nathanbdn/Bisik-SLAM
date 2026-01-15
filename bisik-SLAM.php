<?php
require __DIR__ . '/phpMQTT.php';   // ou le bon chemin vers phpMQTT.php

use Bluerhinos\phpMQTT;

// Configuration MQTT
$server   = '192.168.xx.xx';  // Adresse IP de ta VM (broker MQTT)
$port     = 1883;
$clientId = 'phpmqtt-publisher-' . uniqid();

// Crée l’objet client
$mqtt = new phpMQTT($server, $port, $clientId);

// Connexion : true = clean session
if (!$mqtt->connect(true, NULL, null, null)) {
    exit("Impossible de se connecter au broker MQTT\n");
}

// Topic & message
$topic   = 'test/topic';
$message = 'Message envoyé depuis PHP avec phpMQTT !';

// Publier
$mqtt->publish($topic, $message, 0);  // QoS = 0

echo "Message publié sur « $topic » : $message\n";

// Déconnecter
$mqtt->close();
