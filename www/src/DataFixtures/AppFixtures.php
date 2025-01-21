<?php

namespace App\DataFixtures;

use App\Entity\Bike;
use App\Entity\Brand;
use App\Entity\Cylenders;
use App\Entity\Image;
use App\Entity\Model;
use App\Entity\Places;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    // propriété pour encoder le MDP
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadPlaces($manager);
        $this->loadCylenders($manager);
        $this->loadModel($manager);
        $this->loadBrand($manager);
        $this->loadBike($manager);
        $this->loadImage($manager);

        $manager->flush();
    }

    /**
     * méthode pour générer des utilisateurs
     * @param ObjectManager $manager
     * @return void
     */
    public function loadUsers(ObjectManager $manager): void
    {
        //on crée un tableau avec les infos des users
        $array_user = [
            [                'email' => 'admin@admin.com', 
                'password'=>'admin',
                'roles' => ['ROLE_ADMIN'],
                'username' => 'administrateur'
            ],
            [
                'email' => 'user@user.com',
                'password' => 'user',
                'roles' => ['ROLE_USER'],
                'username' => 'utilisateur'
            ]
        ];

        //on va boucler sur le tableau pour créer les users
        foreach($array_user as $key => $value)
        {
            //on instancie un user
            $user = new User(); 
            $user->setEmail($value['email']);
            $user->setPassword($this->encoder->hashPassword($user, $value['password']));
            $user->setRoles($value['roles']);
            $user->setUsername($value['username']);
            //on persiste les données
            $manager->persist($user);
        }
    }

    /**
     * méthode pour générer des models
     * @param ObjectManager $manager
     * @return void
     */
    public function loadModel(ObjectManager $manager): void
    {
        $array_model = ['CBR1000', 'CBR600', 'CBR500', 'CBR300', 'CBR125', 'CBR250', 'CBR150', 'CBR50', 'CBR'];
        
        // on boucle sur le tableau pour créer les models
        foreach($array_model as $key => $value)
        {
            //on instancie un model
            $model = new Model();
            $model->setModelName($value);
            //on persiste les données
            $manager->persist($model);
            // on ajoute une référence pour pouvoir l'utiliser dans une autre entité
            $this->addReference('model_'.$key + 1, $model);
        }
    }

    /**
     * méthode pour générer des brands
     * @param ObjectManager $manager
     * @return void
     */
    public function loadBrand(ObjectManager $manager): void
    {
        $array_brand = ['Yamaha', 'Honda', 'Suzuki', 'Kawasaki', 'Ducati', 'BMW', 'Triumph', 'KTM', 'Aprilia', 'Harley Davidson'];
        
        // on boucle sur le tableau pour créer les brands
        foreach($array_brand as $key => $value)
        {
            //on instancie un brand
            $brand = new Brand();
            $brand->setBrandName($value);
            //on persiste les données
            $manager->persist($brand);
            // on ajoute une référence pour pouvoir l'utiliser dans une autre entité
            $this->addReference('brand_'.$key + 1, $brand);
        }
    }

    /**
     * méthode pour générer des cylenders
     * @param ObjectManager $manager
     * @return void
     */
    public function loadCylenders(ObjectManager $manager): void
    {
        $array_cylenders = ['1000', '500', '300', '125', '250', '150', '50'];
        
        // on boucle sur le tableau pour créer les cylenders
        foreach($array_cylenders as $key => $value)
        {
            //on instancie un cylenders
            $cylenders = new Cylenders();
            $cylenders->setCC($value);
            //on persiste les données
            $manager->persist($cylenders);
            // on ajoute une référence pour pouvoir l'utiliser dans une autre entité
            $this->addReference('cylenders_'.$key + 1, $cylenders);
        }
    }

    /**
     * méthode pour générer des motos
     * @param ObjectManager $manager
     * @return void
     */
    public function loadBike(ObjectManager $manager): void
    {
        $array_bike = [
            ['releaseDate' => new \DateTime ('2019-05-02'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitisoptio recusandae doloribus. Quod explicabo ratione itaque voluptate tempora eamaiores debitis, molestiae, accusantium id voluptatem officia consequatur eligendidolorem quo.',
            'price' => 2000000,
            'model_id' => 1,
            'brand_id' => 1,
            'cylenders_id' => 1,
            'places' => [1]
        ],
        ['releaseDate' => new \DateTime ('2020-05-02'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitisoptio recusandae doloribus. Quod explicabo ratione itaque voluptate tempora eamaiores debitis, molestiae, accusantium id voluptatem officia consequatur eligendidolorem quo.',
            'price' => 2000000,
            'model_id' => 2,
            'brand_id' => 2,
            'cylenders_id' => 2,
            'places' => [2]
        ],

        ['releaseDate' => new \DateTime ('2021-05-02'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitisoptio recusandae doloribus. Quod explicabo ratione itaque voluptate tempora eamaiores debitis, molestiae, accusantium id voluptatem officia consequatur eligendidolorem quo.',
            'price' => 2000000,
            'model_id' => 3,
            'brand_id' => 3,
            'cylenders_id' => 3,
            'places' => [3]
        ],
        ['releaseDate' => new \DateTime ('2022-05-02'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitisoptio recusandae doloribus. Quod explicabo ratione itaque voluptate tempora eamaiores debitis, molestiae, accusantium id voluptatem officia consequatur eligendidolorem quo.',
            'price' => 2000000,
            'model_id' => 4,
            'brand_id' => 4,
            'cylenders_id' => 4,
            'places' => [4]
        ],
        ['releaseDate' => new \DateTime ('2023-05-02'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitisoptio recusandae doloribus. Quod explicabo ratione itaque voluptate tempora eamaiores debitis, molestiae, accusantium id voluptatem officia consequatur eligendidolorem quo.',
            'price' => 2000000,
            'model_id' => 5,
            'brand_id' => 5,
            'cylenders_id' => 5,
            'places' => [5]
        ],
        ['releaseDate' => new \DateTime ('2024-05-02'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitisoptio recusandae doloribus. Quod explicabo ratione itaque voluptate tempora eamaiores debitis, molestiae, accusantium id voluptatem officia consequatur eligendidolorem quo.',
            'price' => 2000000,
            'model_id' => 6,
            'brand_id' => 6,
            'cylenders_id' => 6,
            'places' => [6]
        ],
            
        ];
        // on boucle sur le tableau pour créer les motos
        foreach($array_bike as $key => $value)
        {
            // on instancie un bike
            $bike = new Bike();
            $bike->setReleaseDate($value['releaseDate']);
            $bike->setDescription($value['description']);
            $bike->setPrice($value['price']);
            $bike->setModelId($this->getReference('model_' . $value['model_id'], Model::class));
            $bike->setBrandId($this->getReference('brand_' . $value['brand_id'], Brand::class));
            $bike->setCylendersId($this->getReference('cylenders_' . $value['cylenders_id'], Cylenders::class));

            
            //on va devoir boucler sur $value['places'] pour faire les relations du many to many
            foreach($value['places'] as $place){
                $bike->addPlace($this->getReference('places_'.$place, Places::class));

            };
            
            
            // on persiste les données
            $manager->persist($bike);
            // on ajoute une référence pour pouvoir l'utiliser dans une autre entité
            $this->addReference('bike_'.$key + 1, $bike);
        }
    }

    /**
     * méthode pour générer des images
     * @param ObjectManager $manager
     * @return void
     */
    public function loadImage(ObjectManager $manager): void
    {
        $array_image = [
            ['imagePath' => 'image1.jpg',
            'bike_id' => '1'], 
            ['imagePath' =>'image2.jpg',
            'bike_id' => '2'],
            ['imagePath' =>'image3.jpg',
            'bike_id' => '3'],
            ['imagePath' =>'image4.jpg',
            'bike_id' => '4'],
            ['imagePath' =>'image5.jpg',
            'bike_id' => '5'],
            ['imagePath' =>'image6.jpg',
            'bike_id' => '6']
        ];
        // on boucle sur le tableau pour créer les images
        foreach($array_image as $key => $value)
        {
            //on instancie un image
            $image = new Image();
            $image->setImagePath($value['imagePath']);
            $image->setBikeId($this->getReference('bike_' . $value['bike_id'], Bike::class));
            //on persiste les données
            $manager->persist($image);
            // on ajoute une référence pour pouvoir l'utiliser dans une autre entité
            $this->addReference('image_'.$key + 1, $image);
        }
    }


    public function loadPlaces(ObjectManager $manager)
    {
        $array_places = [1,2,3,4,5,6];
        
        // on boucle sur le tableau pour créer les places
        foreach($array_places as $key => $value)
        {
            //on instancie un place
            $place = new Places();
            $place->setNbr($value);
            //on persiste les données
            $manager->persist($place);
            // on ajoute une référence pour pouvoir l'utiliser dans une autre entité
            $this->addReference('places_'.$key + 1, $place);
        }
    }
}
