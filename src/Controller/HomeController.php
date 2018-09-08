<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/8/18
 * Time: 9:01 AM
 */

namespace App\Controller;

use App\Entity\UserInfo;
use App\Repository\UserInfoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Omines\DataTablesBundle\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Victorybiz\GeoIPLocation\GeoIPLocation;
use Symfony\Component\Routing\Annotation\Route;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\TextColumn;


class HomeController
{
    use Controller\DataTablesTrait;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserInfoRepository
     */
    private $repository;
    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(EntityManagerInterface $entityManager, UserInfoRepository $repository, ContainerInterface $container, \Twig_Environment $twig)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->container = $container;
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="tracker_index")
     */
    public function index(Request $request)
    {



        $geoip = new GeoIPLocation();
        $geoip->setIP('74.125.224.72');

        $userInfo = $this->repository->findOneBy(['ip'=>$geoip->getIP()]);

        if($userInfo == NULL){

            $userInfo = new UserInfo();
            $userInfo->setIp($geoip->getIP());
            $userInfo->setCity($geoip->getCity());
            $userInfo->setContinent($geoip->getContinent());
            $userInfo->setContinentCode($geoip->getContinentCode());
            $userInfo->setCountry($geoip->getCountry());
            $userInfo->setCountryCode($geoip->getCountryCode());
            $userInfo->setCurrencyCode($geoip->getCurrencyCode());
            $userInfo->setCurrencyExchangeRate($geoip->getCurrencyExchangeRate());
            $userInfo->setCurrencySymbol($geoip->getCurrencySymbol());
            $userInfo->setLatitude($geoip->getLatitude());
            $userInfo->setLongitude($geoip->getLongitude());
            $userInfo->setPostalCode($geoip->getPostalCode());
            $userInfo->setRegion($geoip->getRegion());
            $userInfo->setRegionCode($geoip->getRegionCode());
            $userInfo->setCount(1);

        }else{
            $userInfo->setCount($userInfo->getCount()+1);
        }

        try{
            $this->entityManager->persist($userInfo);
            $this->entityManager->flush();
        }catch (\Exception $e){
            var_dump($e);
        }

        return new Response();
    }

    /**
     * @Route("/admin", name="tracker_admin")
     */
    public function admin(Request $request)
    {

        $all = $this->repository->findAll();

        return new Response($this->twig->render('index.html.twig', ['data'=>$all]));

    }

}