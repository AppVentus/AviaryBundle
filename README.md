AviaryBundle
============

##Description

This bundle provides multiple file uploads, based on the BlueImp jQuery file uploader package.
It provides also Aviary editing image functionnalities.

##Installation

###Step 1

With Composer:

Add this line in your composer.json file:
    "appventus/aviary-bundle" : "dev-master" 

Declare the bundle in your AppKernel.php:
    public function registerBundles() {
        $bundles = array(
            [...]
            new AppVentus\AviaryBundle\AviaryBundle(),
            [...]

###Step 2 : Entity

In your YourEntity.php, add a OneToOne Relation with a Gallery

    /**
     * @ORM\OneToOne(targetEntity="Appventus\AviaryBundle\Entity\Gallery", cascade={"persist"})
     */
    private $gallery;

    /**
     * Set gallery
     *
     * @param \Appventus\AviaryBundle\Entity\Gallery $gallery
     * @return Product
     */
    public function setGallery(\Appventus\AviaryBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Appventus\AviaryBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }

###Step 3 : Form Type

In your YourEntityType.php, add the GalleryType
    use Appventus\AviaryBundle\Form\GalleryType;
    class YourEntityType extends AbstractType
    {
        /**
         * @param FormBuilderInterface $builder
         * @param array $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                [...]
                ->add('gallery', new GalleryType())
                [...]
            ;
        }
    }

###Step 4

Add "aviary.uploadpath" parameter to your config.yml :

    parameters:
        aviary.uploadpath: /

And add "AviaryBundle:Form:fields.html.twig" to your twig.yml :

    twig:
        form:
            resources:
                - 'AviaryBundle:Form:fields.html.twig'

###Step 5 : Add styles and scripts

####AsseticInjectorBundle way

If You have installed our insanous [AsseticInjectorBundle](https://github.com/AppVentus/AsseticInjectorBundle/edit/master/README.md) bundle:

    1. You are awesome ;)
    2. you just have to add the injector tags in your javascript (injector="aviary_scripts") and stylesheet (injector="aviary_styles") blocks.

####The poor, bad and ancestral way !

    1. Just add in your assetic 
        {% javascripts
            "@AviaryBundle/Resources/public/js/jquery.min.js",
            "@AviaryBundle/Resources/public/jQuery-File-Upload-9.5.8/js/vendor/jquery.ui.widget.js",
            "@AviaryBundle/Resources/public/js/tmpl.min.js",
            "@AviaryBundle/Resources/public/js/load-image.min.js",
            "@AviaryBundle/Resources/public/js/canvas-to-blob.min.js",
            "@AviaryBundle/Resources/public/js/bootstrap.min.js",
            "@AviaryBundle/Resources/public/js/jquery.blueimp-gallery.min.js",
            "@AviaryBundle/Resources/public/jQuery-File-Upload-9.5.8/js/jquery.iframe-transport.js",
            "@AviaryBundle/Resources/public/jQuery-File-Upload-9.5.8/js/jquery.fileupload.js",
            "@AviaryBundle/Resources/public/jQuery-File-Upload-9.5.8/js/jquery.fileupload-process.js",
            "@AviaryBundle/Resources/public/jQuery-File-Upload-9.5.8/js/jquery.fileupload-image.js",
            "@AviaryBundle/Resources/public/jQuery-File-Upload-9.5.8/js/jquery.fileupload-validate.js",
            "@AviaryBundle/Resources/public/jQuery-File-Upload-9.5.8/js/jquery.fileupload-ui.js",
            "@AviaryBundle/Resources/public/jQuery-File-Upload-9.5.8/js/main.js",
            "@AviaryBundle/Resources/public/js/feather.js",
            "@AviaryBundle/Resources/public/js/aviary.js"
        %}
            <script src="{{ asset_url }}"></script>
        {% endjavascripts %}

    2. Just add in your assetic
        {% stylesheets 
            "@AviaryBundle/Resources/public/css/bootstrap.min.css",
            "@AviaryBundle/Resources/public/css/blueimp-gallery.min.css",
            "@AviaryBundle/Resources/public/jQuery-File-Upload-9.5.8/css/jquery.fileupload.css",
            "@AviaryBundle/Resources/public/jQuery-File-Upload-9.5.8/css/jquery.fileupload-ui.css"
        %}
            <link rel="stylesheet" href="{{ asset_url }}" />
        {% endstylesheets %}

###Step 6 : The Form !
    {{ form_start(form, {'method': 'POST', 'attr' : {'id' : 'fileupload'}}) }}
    {{ form_widget(form.gallery) }}
    {{ form_rest(form) }}
    <input type="submit" name="submit" value="Submit" />
    {{ form_end(form) }}

###Step 7 : Optionnal

Additional configuration :

Files will be inside /web/bundles/aviary/jQuery-File-Upload-9.5.8/server/php/files/

You can customize move uploaded pictures in another directory with a listener.
