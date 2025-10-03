<?php
defined('BASEPATH') or exit('No direct script access allowed');


/* ===== Documentation ===== 
Name: Home
Role: Controller
Description: Controls access to SEO
Author: Sylvester Esso Nmakwe
Date Created: 125th July, 2025
*/



class Seo extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
    }


    public function sitemap()
    {
        // Start with your static pages
        $pages = [
            ['loc' => base_url(), 'lastmod' => '2025-01-01'], // Use a fixed date for the homepage
            ['loc' => base_url('about'), 'lastmod' => '2025-01-01'],
            ['loc' => base_url('awards'), 'lastmod' => '2025-01-01'],
            ['loc' => base_url('affiliate'), 'lastmod' => '2025-01-01'],
            ['loc' => base_url('staff'), 'lastmod' => '2025-01-01'],
            ['loc' => base_url('events'), 'lastmod' => '2025-01-01'],
            ['loc' => base_url('contact'), 'lastmod' => '2025-01-01'],
            // etc.
        ];

        // Get dynamic property pages
        $projects = $this->common_model->get_project(); // Fictional method

        foreach ($projects as $project) {
            $pages[] = [
                // Assuming your property URL is base_url('properties/view/' . $property->slug)
                'loc' => base_url('projects/' . $project->slug),
                // Use the actual update timestamp from your database
                'lastmod' => date('Y-m-d', strtotime($project->date_added))
            ];
        }

        // You could do the same for projects, events, etc.

        $data['pages'] = $pages;

        $this->output->set_content_type('application/xml', 'utf-8')->set_output(
            $this->load->view('sitemap', $data, true)
        );
    }

    public function robots()
    {
        // Pass the base_url to the view
        $data['sitemap_url'] = base_url('sitemap.xml');

        $this->output
            ->set_content_type('text/plain', 'utf-8')
            ->set_output($this->load->view('robots', $data, true));
    }
}
