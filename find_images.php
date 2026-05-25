<?php
$motos = [
    'Honda CBR1000RR',
    'Honda Africa Twin',
    'Honda CB650R',
    'Honda Rebel 500',
    'Honda CB125F',
    'Honda CB500F',
    'Honda CB750 Hornet',
    'Honda XL750 Transalp',
    'Honda CB500X',
    'Honda X-ADV',
    'Honda XR150L',
    'Honda CRF250',
    'Honda Navi'
];

$results = [];

$options = [
    'http' => [
        'header' => "User-Agent: TraeAI/1.0\r\n"
    ]
];
$context = stream_context_create($options);

foreach ($motos as $moto) {
    // Search for images on Wikimedia
    $search_url = "https://commons.wikimedia.org/w/api.php?action=query&list=search&srsearch=" . urlencode($moto) . "&srnamespace=6&format=json&srlimit=3";
    $json = file_get_contents($search_url, false, $context);
    $data = json_decode($json, true);
    
    $images = [];
    if (!empty($data['query']['search'])) {
        foreach ($data['query']['search'] as $item) {
            $title = $item['title'];
            // Get image info
            $info_url = "https://commons.wikimedia.org/w/api.php?action=query&prop=imageinfo&iiprop=url&titles=" . urlencode($title) . "&format=json";
            $info_json = file_get_contents($info_url, false, $context);
            $info_data = json_decode($info_json, true);
            
            if (!empty($info_data['query']['pages'])) {
                $page = reset($info_data['query']['pages']);
                if (!empty($page['imageinfo'][0]['url'])) {
                    $images[] = $page['imageinfo'][0]['url'];
                }
            }
        }
    }
    $results[$moto] = $images;
    echo "Found " . count($images) . " images for $moto\n";
}

file_put_contents('found_images.json', json_encode($results, JSON_PRETTY_PRINT));
echo "Saved to found_images.json\n";
