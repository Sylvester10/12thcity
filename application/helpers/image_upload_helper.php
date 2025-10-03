<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Handles a single file upload.
 *
 * @param string $fieldName The name of the file input field (e.g., 'event_image').
 * @param array  $configOverrides Optional array to override default upload configurations.
 * @return array A structured response array: ['status' => bool, 'data' => array/string, 'error' => string].
 */
function upload_single_image($fieldName, $configOverrides = [])
{
    $CI = &get_instance();

    // --- Default Configuration ---
    $config = [
        'upload_path'      => './assets/uploads/events/',
        'allowed_types'    => 'jpg|jpeg|png',
        'max_size'         => 5024, // 5MB
        'file_ext_tolower' => TRUE,
        'encrypt_name'     => TRUE,
    ];

    // Merge any overrides from the controller
    $config = array_merge($config, $configOverrides);

    $CI->load->library('upload', $config);
    // Re-initialize to apply new config if library was used before
    $CI->upload->initialize($config);

    if ($CI->upload->do_upload($fieldName)) {
        return [
            'status'   => true,
            'data'     => $CI->upload->data(),
            'filename' => $CI->upload->data('file_name'),
            'error'    => ''
        ];
    } else {
        return [
            'status'   => false,
            'data'     => null,
            'filename' => '',
            'error'    => $CI->upload->display_errors('', '')
        ];
    }
}

/**
 * Handles a multiple file upload field.
 *
 * @param string $fieldName The name of the file input field (e.g., 'other_images[]').
 * @param array  $configOverrides Optional array to override default upload configurations.
 * @return array A structured response array: ['uploaded_files' => array, 'errors' => array].
 */
function upload_multiple_images($fieldName, $configOverrides = [])
{
    $CI = &get_instance();

    // --- Default Configuration (can be the same as single) ---
    $config = [
        'upload_path'      => './assets/uploads/events/',
        'allowed_types'    => 'jpg|jpeg|png',
        'max_size'         => 5024, // 5MB
        'file_ext_tolower' => TRUE,
        'encrypt_name'     => TRUE,
    ];

    $config = array_merge($config, $configOverrides);

    $CI->load->library('upload', $config);
    // Re-initialize to apply new config if library was used before
    $CI->upload->initialize($config);

    $uploaded_files = [];
    $errors = [];

    // Check if any files were actually selected
    if (!empty($_FILES[$fieldName]['name']) && count(array_filter($_FILES[$fieldName]['name'])) > 0) {
        $files = $_FILES[$fieldName];

        foreach ($files['name'] as $key => $image_name) {
            // Restructure the $_FILES array for the CI Upload library
            $_FILES['multiple_image']['name']     = $files['name'][$key];
            $_FILES['multiple_image']['type']     = $files['type'][$key];
            $_FILES['multiple_image']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['multiple_image']['error']    = $files['error'][$key];
            $_FILES['multiple_image']['size']     = $files['size'][$key];

            if ($CI->upload->do_upload('multiple_image')) {
                $uploaded_files[] = $CI->upload->data('file_name');
            } else {
                $errors[] = 'Image "' . htmlspecialchars($image_name) . '": ' . $CI->upload->display_errors('', '');
            }
        }
    }

    return [
        'uploaded_files' => $uploaded_files,
        'errors'         => $errors
    ];
}
