<?php

namespace AppVentus\AviaryBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('aviary');

        $rootNode
            ->children()
                ->scalarNode('upload_dir')->defaultValue("%kernel.root_dir%/../web/uploads/gallery/")->end()
            ->end()
            ->children()
                ->scalarNode('upload_url')->defaultValue("/uploads/gallery/")->end()
            ->end()
            ->children()
                ->scalarNode('user_dirs')->defaultFalse()->end()
            ->end()
            ->children()
                ->scalarNode('mkdir_mode')->defaultValue("0755")->end()
            ->end()
            ->children()
                ->scalarNode('param_name')->defaultValue("files")->end()
            ->end()
            ->children()
                // Set the following option to 'POST', if your server does not support
                // DELETE requests. This is a parameter sent to the client:
                ->scalarNode('delete_type')->defaultValue("DELETE")->end()
            ->end()
            ->children()
                ->scalarNode('access_control_allow_origin')->defaultValue("*")->end()
            ->end()
            ->children()
                ->scalarNode('access_control_allow_credentials')->defaultFalse()->end()
            ->end()
            ->children()
                ->variableNode('access_control_allow_methods')
                    ->defaultValue(array(
                        'OPTIONS',
                        'HEAD',
                        'GET',
                        'POST',
                        'PUT',
                        'PATCH',
                        'DELETE'
                    ))
                ->end()
            ->end()
            ->children()
                ->variableNode('access_control_allow_headers')
                    ->defaultValue(array(
                        'Content-Type',
                        'Content-Range',
                        'Content-Disposition'
                    ))
                ->end()
            ->end()
            // Enable to provide file downloads via GET requests to the PHP script:
            //     1. Set to 1 to download files via readfile method through PHP
            //     2. Set to 2 to send a X-Sendfile header for lighttpd/Apache
            //     3. Set to 3 to send a X-Accel-Redirect header for nginx
            // If set to 2 or 3, adjust the upload_url option to the base path of
            // the redirect parameter, e.g. '/files/'.
            ->children()
                ->scalarNode('download_via_php')->defaultValue(false)->end()
            ->end()
            // Read files in chunks to avoid memory limits when download_via_php
            // is enabled, set to 0 to disable chunked reading of files:
            ->children()
                ->scalarNode('readfile_chunk_size')->defaultValue(10 * 1024 * 1024)->end()
            ->end()
            // Defines which files can be displayed inline when downloaded:
            ->children()
                ->scalarNode('inline_file_types')->defaultValue('/\.(gif|jpe?g|png)$/i')->end()
            ->end()
            // Defines which files (based on their names) are accepted for upload:
            ->children()
                ->scalarNode('accept_file_types')->defaultValue('/.+$/i')->end()
            ->end()
            ->children()
                ->scalarNode('max_file_size')->defaultNull()->end()
            ->end()
            ->children()
                ->scalarNode('min_file_size')->defaultValue(1)->end()
            ->end()
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting:
            ->children()
                ->scalarNode('max_number_of_files')->defaultNull()->end()
            ->end()
            // Defines which files are handled as image files:
            ->children()
                ->scalarNode('image_file_types')->defaultValue('/\.(gif|jpe?g|png)$/i')->end()
            ->end()
            // Image resolution restrictions:
            ->children()
                ->scalarNode('max_width')->defaultNull()->end()
            ->end()
            ->children()
                ->scalarNode('max_height')->defaultNull()->end()
            ->end()
            ->children()
                ->scalarNode('min_width')->defaultValue(1)->end()
            ->end()
            ->children()
                ->scalarNode('min_height')->defaultValue(1)->end()
            ->end()
            // Set the following option to false to enable resumable uploads:
            ->children()
                ->scalarNode('discard_aborted_uploads')->defaultValue(true)->end()
            ->end()
            // Set to 0 to use the GD library to scale and orient images,
            // set to 1 to use imagick (if installed, falls back to GD),
            // set to 2 to use the ImageMagick convert binary directly:
            ->children()
                ->scalarNode('image_library')->defaultValue(1)->end()
            ->end()
            // Uncomment the following to define an array of resource limits
            // for imagick:
            ->children()
                ->variableNode('imagick_resource_limits')->defaultValue(array(
                    // imagick::RESOURCETYPE_MAP => 32,
                    // imagick::RESOURCETYPE_MEMORY => 32
            ))->end()
            ->end()
            // Command or path for to the ImageMagick convert binary:
            ->children()
                ->scalarNode('convert_bin')->defaultValue('convert')->end()
            ->end()
            // Uncomment the following to add parameters in front of each
            // ImageMagick convert call (the limit constraints seem only
            // to have an effect if put in front):
            ->children()
                ->scalarNode('convert_params')->defaultValue('-limit memory 32MiB -limit map 32MiB')->end()
            ->end()
            // Command or path for to the ImageMagick identify binary:
            ->children()
                ->scalarNode('identify_bin')->defaultValue('identify')->end()
            ->end()
            ->children()
                ->arrayNode('image_versions')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('auto_orient')->end()
                            ->scalarNode('max_width')->end()
                            ->scalarNode('max_height')->end()
                            ->scalarNode('upload_dir')->end()
                            ->scalarNode('upload_url')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        return $treeBuilder;
    }
}
