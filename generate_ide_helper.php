<?php
// generate_ide_helper.php

$modelsPath = __DIR__ . '/application/models/';
$helperPath = __DIR__ . '/_ide_helper.php';

$properties = [];

// 1. Scan the models directory
if (is_dir($modelsPath)) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($modelsPath));
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $className = $file->getBasename('.php');
            // CI models are typically accessed via lowercase names: $this->common_model
            $propertyName = strtolower($className);
            $properties[] = " * @property {$className} \${$propertyName}";
        }
    }
}

// 2. Define standard Core CI properties
$coreProps = [
    " * @property CI_DB_query_builder \$db",
    " * @property CI_Input            \$input",
    " * @property CI_Session          \$session",
    " * @property CI_Loader           \$load",
    " * @property CI_Config           \$config",
    " * ------------- YOUR CUSTOM MODELS -------------"
];

// 3. Merge them together
$allProps = array_merge($coreProps, $properties);
$docBlock = implode("\n", $allProps);

// 4. Build the file content
$content = <<<PHP
<?php
// Stop execution so this file never accidentally runs in production
die('This file is for IDE autocomplete only.');

/**
 * ------------- CORE CODEIGNITER CLASSES -------------
$docBlock
 */
class CI_Controller {}

/**
 * ------------- CORE CODEIGNITER CLASSES -------------
$docBlock
 */
class CI_Model {}

PHP;

// 5. Write to _ide_helper.php
file_put_contents($helperPath, $content);
echo "_ide_helper.php has been successfully generated with " . count($properties) . " models!\n";
