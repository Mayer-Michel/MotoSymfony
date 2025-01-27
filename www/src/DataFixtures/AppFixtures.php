<?php

namespace App\DataFixtures;

use App\Entity\Bike;
use App\Entity\Brand;
use App\Entity\Cylender;
use App\Entity\Model;
use App\Entity\Place;
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
        $this->loadCylenders($manager);
        $this->loadModel($manager);
        $this->loadBrand($manager);
        $this->loadBike($manager);
        $this->loadPlaces($manager);

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
            ],
            [
                'email' => 'user@user.com',
                'password' => 'user',
                'roles' => ['ROLE_USER'],
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
            $cylenders = new Cylender();
            $cylenders->setCylenders($value);
            //on persiste les données
            $manager->persist($cylenders);
            // on ajoute une référence pour pouvoir l'utiliser dans une autre entité
            $this->addReference('cylenders_'.$key + 1, $cylenders);
        }
    }
    /**
     * méthode pour générer des places
     * @param ObjectManager $manager
     * @return void
     */
    public function loadPlaces(ObjectManager $manager): void
    {
        $array_nbr = ['4', '3', '2', '1'];
        
        // on boucle sur le tableau pour créer les cylenders
        foreach($array_nbr as $key => $value)
        {
            //on instancie un cylenders
            $nbr = new Place();
            $nbr->setNbr($value);
            //on persiste les données
            $manager->persist($nbr);
            // on ajoute une référence pour pouvoir l'utiliser dans une autre entité
            $this->addReference('nbr_' . $key + 1, $nbr);
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
            'image' => 'image1.jpg',
            'price' => 2000000,
            'model' => 1,
            'brand' => 1,
            'cylender' => 1,
            'place' => 1,
        ],
        ['releaseDate' => new \DateTime ('2020-05-02'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitisoptio recusandae doloribus. Quod explicabo ratione itaque voluptate tempora eamaiores debitis, molestiae, accusantium id voluptatem officia consequatur eligendidolorem quo.',
            'image' => 'image2.jpg',
            'price' => 2200000,
            'model' => 2,
            'brand' => 2,
            'cylender' => 2,
            'place' => 2,
        ],

        ['releaseDate' => new \DateTime ('2021-05-02'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitisoptio recusandae doloribus. Quod explicabo ratione itaque voluptate tempora eamaiores debitis, molestiae, accusantium id voluptatem officia consequatur eligendidolorem quo.',
            'image' => 'image3.jpg',
            'price' => 2300000,
            'model' => 3,
            'brand' => 3,
            'cylender' => 3,
            'place' => 3,
        ],
        ['releaseDate' => new \DateTime ('2022-05-02'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitisoptio recusandae doloribus. Quod explicabo ratione itaque voluptate tempora eamaiores debitis, molestiae, accusantium id voluptatem officia consequatur eligendidolorem quo.',
            'image' => 'image4.jpg',
            'price' => 2400000,
            'model' => 4,
            'brand' => 4,
            'cylender' => 4,
            'place' => 4,
        ],
        ['releaseDate' => new \DateTime ('2023-05-02'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitisoptio recusandae doloribus. Quod explicabo ratione itaque voluptate tempora eamaiores debitis, molestiae, accusantium id voluptatem officia consequatur eligendidolorem quo.',
            'image' => 'image5.jpg',
            'price' => 2500000,
            'model' => 5,
            'brand' => 5,
            'cylender' => 5,
            'place' => 2,
        ],
        ['releaseDate' => new \DateTime ('2024-05-02'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitisoptio recusandae doloribus. Quod explicabo ratione itaque voluptate tempora eamaiores debitis, molestiae, accusantium id voluptatem officia consequatur eligendidolorem quo.',
            'image' => 'image6.jpg',
            'price' => 2600000,
            'model' => 6,
            'brand' => 6,
            'cylender' => 6,
            'place' => 3,
        ],
            
        ];
        // on boucle sur le tableau pour créer les motos
        foreach($array_bike as $key => $value)
        {
            // on instancie un bike
            $bike = new Bike();
            $bike->setReleaseDate($value['releaseDate']);
            $bike->setDescription($value['description']);
            $bike->setImage($value['image']);
            $bike->setPrice($value['price']);
            $bike->setModel($this->getReference('model_' . $value['model'], Model::class));
            $bike->setBrand($this->getReference('brand_' . $value['brand'], Brand::class));
            $bike->setCylender($this->getReference('cylenders_' . $value['cylender'], Cylender::class));
            $bike->setPlace($this->getReference('nbr_' . $value['place'], Place::class));
            };
            
            
            // on persiste les données
            $manager->persist($bike);
            // on ajoute une référence pour pouvoir l'utiliser dans une autre entité
            $this->addReference('bike_'.$key + 1, $bike);
        }
    }

