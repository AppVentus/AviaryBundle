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

If You have installed our [AsseticInjectorBundle](https://github.com/AppVentus/AsseticInjectorBundle/edit/master/README.md) bundle, add the injector tags :

- javascripts (injector="aviary_scripts")
- stylesheets (injector="aviary_styles")


###Step 6 : The Form !
    {{ form_start(form, {'method': 'POST', 'attr' : {'id' : 'fileupload'}}) }}
    {{ form_widget(form.gallery) }}
    {{ form_rest(form) }}
    <input type="submit" name="submit" value="Submit" />
    {{ form_end(form) }}

###Step 7 : Main script

```javascript
var featherEditor = new Aviary.Feather({
    apiKey: 'yourapikey',
    apiVersion: 3,
    theme: 'dark',
    appendTo: '',
    language: 'fr',
    onSave: function(imageID, newURL) {
        postImage(imageID, newURL);
        featherEditor.close();
        return false;
    },
    onError: function(errorObj) {
        alert(errorObj.message);
    }
});
```