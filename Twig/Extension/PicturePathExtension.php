<?php

namespace AppVentus\AviaryBundle\Twig\Extension;

use AppVentus\AviaryBundle\Entity\Picture;
use Symfony\Component\HttpFoundation\File\File;
 /**
  * undocumented class
  *
  * @package default
  * @author
  **/
 class PicturePathExtension extends \Twig_Extension
 {

    protected $aviaryOptions;

    public function __construct($aviaryOptions)
    {
        $this->aviaryOptions = $aviaryOptions;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'avPicturePath';
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('avPicturePath', [$this, 'avPicturePath']),
            new \Twig_SimpleFilter('avPictureBase64', [$this, 'avPictureBase64']),
            new \Twig_SimpleFilter('avPictureVersionPath', [$this, 'avPictureVersionPath']),
            new \Twig_SimpleFilter('avPictureVersionBase64', [$this, 'avPictureVersionBase64'])
        ];
    }

    /**
     * generates the path for a picture
     * @param \Twig_Environment $environment
     * @param Session         $session
     *
     * @return string
     */
    public function avPicturePath($path)
    {
        $url = $path ? $this->aviaryOptions['upload_url'] . $path : null;

        return $url;
    }
    /**
     * generates the base64 for a picture
     * @param \Twig_Environment $environment
     * @param Session         $session
     *
     * @return string
     */
    public function avPictureBase64($path)
    {
        $path = $this->aviaryOptions['upload_dir'] . $path;
        $base64 = $this->convertToBase64($path);

        return $base64;
    }

    /**
     * generates the path for a picture's thumbnail
     * @param \Twig_Environment $environment
     * @param Session         $session
     *
     * @return string
     */
    public function avPictureVersionPath($path, $version)
    {
        if (empty($this->aviaryOptions['image_versions'][$version])) {
            throw new \Exception('The requested "' . $version . '" version of the image was not found, check it is well configured under "image_versions" parameter.');
        }
        $url = $this->aviaryOptions['image_versions'][$version]['upload_url'] . $path;

        return $url;
    }
    /**
     * generates the path for a picture's thumbnail
     * @param \Twig_Environment $environment
     * @param Session         $session
     *
     * @return string
     */
    public function avPictureVersionBase64($path, $version)
    {
        if (empty($this->aviaryOptions['image_versions'][$version])) {
            throw new \Exception('The requested "' . $version . '" version of the image was not found, check it is well configured under "image_versions" parameter.');
        }
        $path = $this->aviaryOptions['image_versions'][$version]['upload_dir'] . $path;
        $base64 = $this->convertToBase64($path);

        return $base64;
    }

    public function convertToBase64($path)
    {
        $file = new File($path, true);
        if (!$file->isFile() || 0 !== strpos($file->getMimeType(), 'image/')) {
            return;
        }
        $binary = file_get_contents($path);

        return sprintf('data:image/%s;base64,%s', $file->guessExtension(), base64_encode($binary));
    }

 }
