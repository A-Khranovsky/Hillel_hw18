<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require_once ('admin/db.php');
/** @var PDO $pdo */

$sql = "select * from diplomas;";
$result = $pdo->prepare($sql);
$result->execute();
$diplomas_data = $result->fetchAll(PDO::FETCH_ASSOC);

$sql = "select * from personal_skills;";
$result = $pdo->prepare($sql);
$result->execute();
$personal_skills_data = $result->fetchAll(PDO::FETCH_ASSOC);

$sql = "select * from professional_skills;";
$result = $pdo->prepare($sql);
$result->execute();
$professional_skills_data = $result->fetchAll(PDO::FETCH_ASSOC);

$sql = "select * from tb_references;";
$result = $pdo->prepare($sql);
$result->execute();
$references_data = $result->fetchAll(PDO::FETCH_ASSOC);

$sql = "select * from work_experience;";
$result = $pdo->prepare($sql);
$result->execute();
$work_experience_data = $result->fetchAll(PDO::FETCH_ASSOC);

$sql = "select data_filter, text from portfolio_filters;";
$result = $pdo->prepare($sql);
$result->execute();
$filters_data = $result->fetchAll(PDO::FETCH_ASSOC);
$portfolio['filter'] = $filters_data;

$sql = "SELECT portfolio_gallery.*, pf.data_filter, pf.text FROM portfolio_gallery JOIN filter_gallery fg
    on portfolio_gallery.id = fg.gallery_id JOIN portfolio_filters pf on fg.filter_id = pf.id;";
$result = $pdo->prepare($sql);
$result->execute();
$portfolio_data = $result->fetchAll(PDO::FETCH_ASSOC);

$new_portfolio_data =[];
foreach($portfolio_data as $item) {
    if(!isset($new_portfolio_data[$item['id']])) {
        $item['filters'][] = ['data_filter' => $item['data_filter'], 'text' => $item['text']];
        $new_portfolio_data[$item['id']] = $item;
    } else {
        $new_portfolio_data[$item['id']]['filters'][] = ['data_filter' => $item['data_filter'], 'text' => $item['text']];
    }
}
$portfolio['gallery'] = $new_portfolio_data;

$firstName = 'Matty';
$lastName = 'Jamson';
$position = 'UX/UI Designer';
$dateBirth = '1989-02-10';

$aboutMe = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis volutpat nec tortor a eleifend.
    Proin nec ligula vel sem luctus porttitor. Cras at interdum libero. Donec nec mauris velit.
    Vestibulum eu eros tortor. Aliquam cursus nunc mauris, nec congue tortor pretium et. 
    Pellentesque feugiat justo in metus laoreet consectetur. Mauris at tempor ipsum, sit amet etae posuere.
    Nunc auctor sollicitudin sem ut molestie. Pellentesque ligula sapien, ullamcorper et tempor id, congue ac sapien.';

/*$professionalSkills = [
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis volutpat nec.',
    'skills' => [
        ['name' => 'Create Wireframe', 'score' => 9],
        ['name' => 'Axure', 'score' => 8],
        ['name' => 'Illustrator', 'score' => 9],
        ['name' => 'Photoshop', 'score' => 7],
        ['name' => 'Digital Marketing', 'score' => 4],
    ],
];*/



/*$personalSkills = [
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis volutpat nec.',
    'skills' => [
        ['name' => 'Communication', 'score' => 85],
        ['name' => 'Team work', 'score' => 80],
        ['name' => 'Leadership', 'score' => 95],
        ['name' => 'Management', 'score' => 85],
    ],
];*/

/*$workExperience = [
    [
        'start_date' => '2013-01-01',
        'end_date' => null,
        'company' => 'Flash media inc.',
        'position' => 'SENIOR UX/UI DESIGNER',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit maxime laborum sequi, magni earum quo soluta sint velit numquam, ipsum illum! Nostrum possimus illo architecto praesentium ut aliquam dolorem.',
        'diff' => null
    ],
    [
        'start_date' => '2011-03-01',
        'end_date' => '2012-12-31',
        'company' => 'Codedash Studio',
        'position' => 'UX DESIGNER',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit maxime laborum sequi, magni earum quo soluta sint velit numquam, ipsum illum! Nostrum possimus illo architecto praesentium ut aliquam dolorem.',
        'diff' => null
    ],
    [
        'start_date' => '2009-07-15',
        'end_date' => '2010-04-28',
        'company' => 'Foursqure Studio',
        'position' => 'VISUAL / UI DESIGNER',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit maxime laborum sequi, magni earum quo soluta sint velit numquam, ipsum illum! Nostrum possimus illo architecto praesentium ut aliquam dolorem.',
        'diff' => null
    ],
];*/

/*$diplomas = [
    [
        'date' => 'JANUARY, 2007',
        'company' => 'Master Degree Of Design',
        'position' => 'UNIVERSITY OF DESIGN',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit maxime laborum sequi, magni earum quo soluta sint velit numquam, ipsum illum! Nostrum possimus illo architecto praesentium ut aliquam dolorem.',
    ],
    [
        'date' => 'JUNE, 2004',
        'company' => 'Bachelor Of Arts',
        'position' => 'UNIVERSITY OF DESIGN',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit maxime laborum sequi, magni earum quo soluta sint velit numquam, ipsum illum! Nostrum possimus illo architecto praesentium ut aliquam dolorem.',
    ],
    [
        'date' => 'JANUARY, 2001',
        'company' => 'Master Degree Of Design',
        'position' => 'UNIVERSITY OF DESIGN',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit maxime laborum sequi, magni earum quo soluta sint velit numquam, ipsum illum! Nostrum possimus illo architecto praesentium ut aliquam dolorem.',
    ],
];*/

/*$portfolio = [
    'filter' => [
        ['data_filter' => '*', 'class' => 'current', 'text' => 'All'],
        ['data_filter' => '.branding', 'class' => null, 'text' => 'Branding'],
        ['data_filter' => '.illustration', 'class' => null, 'text' => 'Illustration'],
        ['data_filter' => '.wordpress', 'class' => null, 'text' => 'Wordpress'],
        ['data_filter' => '.site-template', 'class' => null, 'text' => 'Site Template'],
    ],
    'gallery' => [
        [
            'text' => 'Project Name',
            'title' => 'Project Name 1',
            'filters' => ['wordpress'],
            'href' => 'http://via.placeholder.com/800x600',
            'src' => 'http://via.placeholder.com/300x150',
        ],
        [
            'text' => 'Project Name',
            'title' => 'Project Name 2',
            'filters' => ['branding', 'illustration'],
            'href' => 'http://via.placeholder.com/800x600',
            'src' => 'http://via.placeholder.com/300x150',
        ],
        [
            'text' => 'Project Name',
            'title' => 'Project Name 3',
            'filters' => ['illustration'],
            'href' => 'http://via.placeholder.com/800x600',
            'src' => 'http://via.placeholder.com/300x150',
        ],
        [
            'text' => 'Project Name',
            'title' => 'Project Name 4',
            'filters' => ['branding', 'illustration'],
            'href' => 'http://via.placeholder.com/800x600',
            'src' => 'http://via.placeholder.com/300x150',
        ],
        [
            'text' => 'Project Name',
            'title' => 'Project Name 5',
            'filters' => ['illustration', 'photos'],
            'href' => 'http://via.placeholder.com/800x600',
            'src' => 'http://via.placeholder.com/300x150',
        ],
        [
            'text' => 'Project Name',
            'title' => 'Project Name 6',
            'filters' => ['branding', 'photos'],
            'href' => 'http://via.placeholder.com/800x600',
            'src' => 'http://via.placeholder.com/300x150',
        ],
        [
            'text' => 'Project Name',
            'title' => 'Project Name 7',
            'filters' => ['illustration', 'photos'],
            'href' => 'http://via.placeholder.com/800x600',
            'src' => 'http://via.placeholder.com/300x150',
        ],
        [
            'text' => 'Project Name',
            'title' => 'Project Name 8',
            'filters' => ['site-template'],
            'href' => 'http://via.placeholder.com/800x600',
            'src' => 'http://via.placeholder.com/300x150',
        ],
    ],
]; */

   /* $portfolio['gallery'] =[
    [
        'text' => 'Project Name',
        'title' => 'Project Name 1',
        'filters' => ['wordpress'],
        'href' => 'http://via.placeholder.com/800x600',
        'src' => 'http://via.placeholder.com/300x150',
    ],
    [
        'text' => 'Project Name',
        'title' => 'Project Name 2',
        'filters' => ['branding', 'illustration'],
        'href' => 'http://via.placeholder.com/800x600',
        'src' => 'http://via.placeholder.com/300x150',
    ],
    [
        'text' => 'Project Name',
        'title' => 'Project Name 3',
        'filters' => ['illustration'],
        'href' => 'http://via.placeholder.com/800x600',
        'src' => 'http://via.placeholder.com/300x150',
    ],
    [
        'text' => 'Project Name',
        'title' => 'Project Name 4',
        'filters' => ['branding', 'illustration'],
        'href' => 'http://via.placeholder.com/800x600',
        'src' => 'http://via.placeholder.com/300x150',
    ],
    [
        'text' => 'Project Name',
        'title' => 'Project Name 5',
        'filters' => ['illustration', 'photos'],
        'href' => 'http://via.placeholder.com/800x600',
        'src' => 'http://via.placeholder.com/300x150',
    ],
    [
        'text' => 'Project Name',
        'title' => 'Project Name 6',
        'filters' => ['branding', 'photos'],
        'href' => 'http://via.placeholder.com/800x600',
        'src' => 'http://via.placeholder.com/300x150',
    ],
    [
        'text' => 'Project Name',
        'title' => 'Project Name 7',
        'filters' => ['illustration', 'photos'],
        'href' => 'http://via.placeholder.com/800x600',
        'src' => 'http://via.placeholder.com/300x150',
    ],
    [
        'text' => 'Project Name',
        'title' => 'Project Name 8',
        'filters' => ['site-template'],
        'href' => 'http://via.placeholder.com/800x600',
        'src' => 'http://via.placeholder.com/300x150',
    ]
    ]; */
/*$references = [
    [
        'testimonial' => '“Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit maxime laborum sequi, magni earum quo soluta sint velit numquam, ipsum illum! Nostrum possimus illo architecto praesentium ut aliquam dolorem.”',
        'image' => 'http://via.placeholder.com/100x100',
        'person' => 'Jonathan Doe',
        'position' => 'Project Manager, Matrix Media',
    ],
    [
        'testimonial' => '“Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit maxime laborum sequi, magni earum quo soluta sint velit numquam, ipsum illum! Nostrum possimus illo architecto praesentium ut aliquam dolorem.”',
        'image' => 'http://via.placeholder.com/100x100',
        'person' => 'Jonathan Doe',
        'position' => 'Project Manager, Matrix Media',
    ],
    [
        'testimonial' => '“Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit maxime laborum sequi, magni earum quo soluta sint velit numquam, ipsum illum! Nostrum possimus illo architecto praesentium ut aliquam dolorem.”',
        'image' => 'http://via.placeholder.com/100x100',
        'person' => 'Jonathan Doe',
        'position' => 'Project Manager, Matrix Media',
    ],
    [
        'testimonial' => '“Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit maxime laborum sequi, magni earum quo soluta sint velit numquam, ipsum illum! Nostrum possimus illo architecto praesentium ut aliquam dolorem.”',
        'image' => 'http://via.placeholder.com/100x100',
        'person' => 'Jonathan Doe',
        'position' => 'Project Manager, Matrix Media',
    ],
];*/

$contacts = [
    ['type' => 'google-plus'],
    ['type' => 'facebook'],
    ['type' => 'dribbble'],
    ['type' => 'behance'],
    ['type' => 'linkdin'],
    ['type' => 'twitter'],
    ['type' => 'instagram'],
    ['type' => 'vimeo'],
];

$professionalSkills['description'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis volutpat nec.';
$professionalSkills['skills'] = $professional_skills_data;

$personalSkills['description'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis volutpat nec.';
$personalSkills['skills'] = $personal_skills_data;

$workExperience = $work_experience_data;
$diplomas = $diplomas_data;

$references = $references_data;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateBirth = $_POST['dateBirth'];
    $position = $_POST['position'];
    $aboutMe = $_POST['aboutMe'];

    $professionalSkills['description'] = $_POST['professionalSkills_description'];
    $professionalSkills['skills'] = $_POST['professionalSkills_skills'];

    $personalSkills['description'] = $_POST['personalSkills_description'];
    $personalSkills['skills'] = $_POST['personalSkills_skills'];

    $workExperience = $_POST['workExperience'];
    $diplomas = $_POST['diplomas'];

    $portfolio['filter'] = $_POST['portfolio_filter'];
    $portfolio['gallery'] = $_POST['portfolio_gallery'];

    $references = $_POST['references'];
    $contacts = $_POST['contacts'];
}

$Zone = new DateTimeZone( 'Europe/Kiev');
$Current_date = new DateTime('now', $Zone);
$dateBirth = new DateTime($dateBirth, $Zone);
$Age = $Current_date -> diff($dateBirth);

foreach ($workExperience as &$item) {
    $Start_date = new DateTime($item['start_date'], $Zone);
    $End_date = new DateTime($item['end_date'], $Zone);
    $Diff = $End_date -> diff($Start_date);

    if (($Diff ->y) != 0) {
        $item['diff'][] = $Diff ->y.' '.true_wordform($Diff ->y, 'год','года', 'лет');
    }
    if (($Diff ->m) != 0) {
        $item['diff'][] = $Diff ->m.' '.true_wordform($Diff ->m, 'месяц','месяца', 'месяцев');
    }

    if (($item['end_date'] === null)) {
        $item['end_date'] = 'Present';
    }
    else {
        $Buff_date = new DateTime($item['end_date'], $Zone);
        $item['end_date'] = $Buff_date ->format('Y-m-d');
    }
    $Buff_date = new DateTime($item['start_date'], $Zone);
    $item['start_date'] = $Buff_date ->format('Y-m-d');
}
unset($item);

function true_wordform($num, $form_for_1, $form_for_2, $form_for_5) {
    $num = abs($num) % 100;
    $num_x = $num % 10;
    if ($num > 10 && $num < 20)
        return $form_for_5;
    if ($num_x > 1 && $num_x < 5)
        return $form_for_2;
    if ($num_x == 1)
        return $form_for_1;
    return $form_for_5;
    //https://misha.agency/php/declension-of-the-word.html
}

/*echo '<pre>';
var_dump($portfolio['gallery']);
echo '</pre>'; exit;*/

?><!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Landing Page for Presenting Your Resume">
    <meta name="keywords" content="one page, responsive, html template, responsive landing page">
    <meta name="author" content="ThinkingCoder">
    <title>Flatr - vCard, CV, Resume & Portfolio template</title>
    <!-- FAVICON  -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/bootstrap/css/normalize.css" rel="stylesheet">
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="lib/wowjs/animate.min.css">
    <link rel="stylesheet" href="lib/pretty-photo/prettyPhoto.css">
    <!-- Template CSS -->
    <link rel="stylesheet" id="colors" href="css/layout1-color1.css" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- =========================================
   Navigation
   ========================================== -->
<!--start mobile navigation-->
<div class="nav visible-xs fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-outline inverse btn-sm navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu
                    <i class="fa fa-bars ico-sm"></i></button>
            </div>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase">
                    <li class="page-scroll nav-item">
                        <a class="nav-link scroll-to" data-toggle="collapse" data-target="#navbarResponsive" href="#introduction">introduction</a>
                    </li>
                    <li class="page-scroll nav-item">
                        <a class="nav-link scroll-to" data-toggle="collapse" data-target="#navbarResponsive" href="#skillset">skillset</a>
                    </li>
                    <li class="page-scroll nav-item">
                        <a class="nav-link scroll-to" data-toggle="collapse" data-target="#navbarResponsive" href="#experience">experience</a>
                    </li>
                    <li class="page-scroll nav-item">
                        <a class="nav-link scroll-to" data-toggle="collapse" data-target="#navbarResponsive" href="#portfolio">portfolio</a>
                    </li>
                    <li class="page-scroll nav-item">
                        <a class="nav-link scroll-to" data-toggle="collapse" data-target="#navbarResponsive" href="#references">references</a>
                    </li>
                    <li class="page-scroll nav-item">
                        <a class="nav-link scroll-to" data-toggle="collapse" data-target="#navbarResponsive" href="#connect">connect</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--end mobile navigation-->
<nav class="nav-container hidden-xs">
    <ul class="nav">
        <li class="page-scroll">
            <a href="#introduction">introduction</a>
        </li>
        <li class="page-scroll">
            <a href="#skillset">skills</a>
        </li>
        <li class="page-scroll">
            <a href="#experience">experience</a>
        </li>
        <li class="page-scroll">
            <a href="#portfolio">portfolio</a>
        </li>
        <li class="page-scroll">
            <a href="#references">references</a>
        </li>
        <li class="page-scroll">
            <a href="#connect">connect</a>
        </li>
    </ul>
</nav>
<!-- =========================================
   Main Container
   ========================================== -->
<div class="container main-container">
    <div class="row">
        <!-- =========================================
           HEADER
           ========================================== -->
        <header>
            <div class="col-md-12 extra-offset-md">
                <button class="btn btn-transparent">
                    <svg>
                        <use xlink:href="img/svg/icons.svg#download"></use>
                    </svg>
                    Download resume
                </button>
                <div class="resume-title">
                    <h2><?=$firstName ?></h2>
                    <h2><?=$lastName ?></h2>
                    <div class="resume-designation extra-offset-md">
                        <span class="border"></span>
                        <span><?php echo $position.' ('.$Age->y.' years)'; ?></span>
                    </div>
                </div>
            </div>
            <div class="header-overlay"></div>
        </header>
        <!-- =========================================
           ABOUT ME
           ========================================== -->
        <section id="introduction">
            <div class="col-md-offset-1 col-md-10">
                <h2 class="title">About Me</h2>
                <hr>
                <p><?= $aboutMe ?></p>
            </div>
        </section>
        <!-- =========================================
           SKILL
           ========================================== -->
        <section id="skillset">
            <div class="col-md-offset-1 col-md-5 offset-lt">
                <h2 class="title">Personal Skills</h2>
                <hr>
                <p><?php echo $personalSkills['description'] ?></p>
                <div class="skill-wrapper">
                    <!--skill-->
                    <ul class="skill" id="skills">
                        <?php for ($i = 0, $length = count($personalSkills['skills']); $i < $length; $i++): ?>
                            <li>
                                <p><?php echo $personalSkills['skills'][$i]['name'] ?></p>
                                <div class="skill-bar wow slideInLeft" data-width="<?php echo $personalSkills['skills'][$i]['score'] ?>">
                                    <span class="skill-tip"></span>
                                </div>
                            </li>
                        <?php endfor ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-5 offset-rt">
                <h2 class="title">Professional Skills</h2>
                <hr>
                <p><?php echo $professionalSkills['description'] ?></p>
                <ul class="skill-dots" id="skill-dots">
                    <?php foreach ($professionalSkills['skills'] as $item): ?>
                        <li class="skill">
                            <span class="skill-title"><?php echo $item['name'] ?></span>
                            <div class="skill-progress" data-score="<?php echo $item['score'] ?>"></div>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </section>
        <!-- =========================================
           WORK
           ========================================== -->
        <section id="experience">
            <div class="col-md-offset-1 col-md-5  offset-lt">
                <h2 class="title">WORK EXPERIENCE</h2>
                <hr>


                <div class="timeline-centered">
                    <?php for ($i = 0, $length = count($workExperience); $i < $length; $i++): ?>
                        <article class="timeline-entry">
                            <div class="timeline-entry-inner">
                                <div class="timeline-icon"></div>
                                <div class="timeline-label">
                                    <?php echo $workExperience[$i]['start_date'].' - '.$workExperience[$i]['end_date'].' '.implode(' ',$workExperience[$i]['diff']) ?>
                                </div>
                                <h3 class="company"><?php echo $workExperience[$i]['company'] ?></h3>
                                <p class="designation"><?php echo $workExperience[$i]['position'] ?> </p>
                                <p class="description"><?php echo $workExperience[$i]['description'] ?></p>
                            </div>
                        </article>
                    <?php endfor ?>
                </div>
            </div>
            <div class="col-md-5  offset-rt">
                <h2 class="title">EDUCATION & DIPLOMAS</h2>
                <hr>
                <div class="timeline-centered">
                    <?php for ($i = 0, $length = count($diplomas); $i < $length; $i++): ?>
                        <article class="timeline-entry">
                            <div class="timeline-entry-inner">
                                <div class="timeline-icon"></div>
                                <div class="timeline-label">
                                    <?php echo $diplomas[$i]['date'] ?>
                                </div>
                                <h3 class="company"><?php echo $diplomas[$i]['company'] ?></h3>
                                <p class="designation"><?php echo $diplomas[$i]['position'] ?></p>
                                <p class="description"> <?php echo $diplomas[$i]['description'] ?></p>
                            </div>
                        </article>
                    <?php endfor ?>
                </div>
            </div>
        </section>
        <!-- =========================================
           PORTFOLIO
           ========================================== -->
        <section id="portfolio">
            <div class="col-md-offset-1 col-md-10">
                <h2 class="title">PORTFOLIO</h2>
                <hr>
                <div class="clearfix"></div>
                <div class="porfolio-wrapper">
                    <div class="portfolioFilter">
                        <ul>
                            <li>
                                <a href="#" data-filter="*"
                                    class="current"> All </a>
                            </li>
                            <?php foreach ($portfolio['filter'] as $item): ?>
                                <li>
                                    <a href="#" data-filter=".<?= $item['data_filter']?>">
                                        <?= $item['text']?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>

                    <?php $buf= ''?>
                    <ul class="portfolioContainer gallery">
                        <?php foreach ($portfolio['gallery'] as $item): ?>
                            <li class="<?php foreach($item['filters'] as $filter_item) {
                                $buf .= $filter_item['data_filter'] .= ' ';
                            }
                            echo $buf;
                            $buf= '';
                            ?>item">
                                <div class="lightCon">
                                    <div class="hoverBox">
                                        <ul class="hover-box-inner">
                                            <li>
                                                <a data-gal="prettyPhoto[gallery1]" title="<?= $item['title']?>" href="<?= $item['href']?>"><i class="fa fa-image"></i></a>
                                            </li>
                                            <li>
                                                <h4><?= $item['text']?></h4>
                                            </li>
                                        </ul>
                                    </div>
                                    <img src="<?= $item['src']?>" alt="">
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </section>
        <!-- =========================================
           REFERENCES
           ========================================== -->
        <section id="references" class="testimonial-outer">
            <div class="col-md-offset-1 col-md-10">
                <h2 class="title">REFERENCES</h2>
                <hr>
            </div>
            <div class="clearfix"></div>
            <?php $testimonial_wrappers = array_chunk($references, 2);
            foreach ($testimonial_wrappers as $testimonial_wrapper_item): ?>
            <div class="testimonial-wrapper">
                <?php $j = 0;
                foreach ($testimonial_wrapper_item as $item):
                if ($j == 0) {
                    echo '<div class="col-md-offset-1 col-md-5 offset-lt">';
                    $j++;
                }
                else {
                    echo '<div class="col-md-5 offset-rt">';
                }?>
                <!--testimonial-block-->
                <div class="testimonial">
                    <div class="testimonialblock">
                        <p><?= $item['testimonial'] ?></p>
                    </div>
                    <div class="user-wrapper">
                        <img src="<?= $item['image'] ?>" alt="">
                        <div class="user-detail">
                            <p class="title"><?= $item['person'] ?></p>
                            <p><?= $item['position'] ?></p>
                        </div>
                    </div>
                </div>
                <!--testimonial-block ends-->
            </div>
        <?php endforeach ?>
    </div>
    <?php endforeach ?>
    </section>
    <!-- =========================================
       CONNECT ME
       ========================================== -->
    <section id="connect" class="connect padding-bottom-0">
        <div class="col-md-offset-1 col-md-10">
            <h2 class="title">CONNECT ME</h2>
            <ul class="social-links social-border">
                <?php for ($i = 0, $length = count($contacts); $i < $length; $i++): ?>
                    <li class="<?=$contacts[$i]['type']?>"><i class="fa fa-<?=$contacts[$i]['type']?>" aria-hidden="true"></i></li>
                <?php endfor ?>
            </ul>
            <hr>
        </div>
        <div class="map_outer">
            <div id="map"></div>
            <!--contact form-->
            <div class="contact_form col-md-4 col-sm-7 col-xs-11">
                <p>Drop me a line</p>
                <div class="alert alert-success hidden" id="successMessage">
                    <strong>Success!</strong> Your message has been sent to us.
                </div>
                <div class="alert alert-danger hidden" id="errorMessage">
                    <strong>Error!</strong> There was an error sending your message.
                </div>
                <form action="php/submitForm.php" method="POST" name="emailSubmission">
                    <div class="col-md-12 ">
                        <label>Enter name</label>
                        <input type="text" class="minimal" name="name" id="name" placeholder="Enter name">
                    </div>
                    <div class="col-md-12">
                        <label>Enter email</label>
                        <input type="text" class="minimal" name="email" id="email" placeholder="Enter email">
                    </div>
                    <div class="col-md-12 ">
                        <label>Enter Subject</label>
                        <input type="text" class="minimal" name="subject" id="subject" placeholder="Enter subject">
                    </div>
                    <div class="col-md-12">
                        <label>Enter message</label>
                        <textarea class="minimal" name="message" id="message" placeholder="Enter message"></textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-md btn-primary inverse pull-right" value="Submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<!--end of Main container-->
</div>
<!-- =========================================
   Footer
   ========================================== -->
<footer>
    © 2017 Flatos.com All right reserved.
    <a href="#">Theme Elite production</a>
</footer>
<!-- =========================
   PRELOADER
   ============================== -->
<div class="loader-wrapper">
    <div class="preload"></div>
</div>
<!-- =========================================
   Scripts
   ========================================== -->
<!-- jQuery -->
<script src="lib/jquery/jquery-3.2.1.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<!-- JQuery Easing -->
<script src="lib/jquery/jquery.easing.min.js"></script>
<!-- Retina LIbrary-->
<script src="lib/retina/retina.min.js"></script>
<!--Wow -->
<script src="lib/wowjs/wow.min.js"></script>
<!-- Isotope Plugin -->
<script src="lib/isotope/isotope.pkgd.js"></script>
<!-- Pretty-Photo Gallery -->
<script src="lib/pretty-photo/jquery.prettyPhoto.min.js"></script>
<!-- Jquery Validator -->
<script src='lib/jquery/jquery.validate.min.js'></script>
<!-- Google Maps -->
<script src="lib/googlemaps/infobubble.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDMQqDC0jmMiZmHAbC_q57Zq3e2obnLMw"></script>
<script>
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 11,
            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(40.702603, -73.788742), // New York
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{ "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#e9e9e9" }, { "lightness": 17 }] }, { "featureType": "landscape", "elementType": "geometry", "stylers": [{ "color": "#f5f5f5" }, { "lightness": 20 }] }, { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{ "color": "#ffffff" }, { "lightness": 17 }] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{ "color": "#ffffff" }, { "lightness": 29 }, { "weight": 0.2 }] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [{ "color": "#ffffff" }, { "lightness": 18 }] }, { "featureType": "road.local", "elementType": "geometry", "stylers": [{ "color": "#ffffff" }, { "lightness": 16 }] }, { "featureType": "poi", "elementType": "geometry", "stylers": [{ "color": "#f5f5f5" }, { "lightness": 21 }] }, { "featureType": "poi.park", "elementType": "geometry", "stylers": [{ "color": "#dedede" }, { "lightness": 21 }] }, { "elementType": "labels.text.stroke", "stylers": [{ "visibility": "on" }, { "color": "#ffffff" }, { "lightness": 16 }] }, { "elementType": "labels.text.fill", "stylers": [{ "saturation": 36 }, { "color": "#333333" }, { "lightness": 40 }] }, { "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "featureType": "transit", "elementType": "geometry", "stylers": [{ "color": "#f2f2f2" }, { "lightness": 19 }] }, { "featureType": "administrative", "elementType": "geometry.fill", "stylers": [{ "color": "#fefefe" }, { "lightness": 20 }] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{ "color": "#fefefe" }, { "lightness": 17 }, { "weight": 1.2 }] }]
        };

        // Get the HTML DOM element that will contain your map
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);
        var infowindow = new InfoBubble({
            shadowStyle: 0,
            padding: 30,
            backgroundColor: '#fff',
            borderRadius: 7,
            arrowSize: 10,
            borderWidth: 0,
            maxWidth: 245,
            borderColor: '#2c2c2c',
            disableAutoPan: true,
            hideCloseButton: true,
            arrowPosition: 30,
            backgroundClassName: 'transparent',
            arrowStyle: 0
        });
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(40.6700, -73.9400),
            icon: new google.maps.MarkerImage('img/svg/marker.svg',
                null, null, null, new google.maps.Size(50, 50)),
            map: map,
            title: 'yo'
        });
        google.maps.event.addListener(marker, 'click', (function(marker) {
            return function() {
                infowindow.setContent('\u003cp\u003eCollins Street West Victoria 8007 Australia.\u003c/p\u003e\u003cp\u003eCall : +1800 1234 56789\u003c/p\u003e');
                infowindow.open(map, marker);
            }
        })(marker));
    }
</script>
<!-- Template Custom scripts -->
<script src="js/scripts.min.js"></script>
</body>
</html>