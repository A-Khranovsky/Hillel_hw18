<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$firstName = 'Matty';
$lastName = 'Jamson';
$position = 'UX/UI Designer';
$dateBirth = '1989-02-10';

$aboutMe = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis volutpat nec tortor a eleifend.
    Proin nec ligula vel sem luctus porttitor. Cras at interdum libero. Donec nec mauris velit.
    Vestibulum eu eros tortor. Aliquam cursus nunc mauris, nec congue tortor pretium et. 
    Pellentesque feugiat justo in metus laoreet consectetur. Mauris at tempor ipsum, sit amet etae posuere.
    Nunc auctor sollicitudin sem ut molestie. Pellentesque ligula sapien, ullamcorper et tempor id, congue ac sapien.';

$professionalSkills = [
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis volutpat nec.',
    'skills' => [
        ['name' => 'Create Wireframe', 'score' => 9],
        ['name' => 'Axure', 'score' => 8],
        ['name' => 'Illustrator', 'score' => 9],
        ['name' => 'Photoshop', 'score' => 7],
        ['name' => 'Digital Marketing', 'score' => 4],
    ],
];

$personalSkills = [
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis volutpat nec.',
    'skills' => [
        ['name' => 'Communication', 'score' => 85],
        ['name' => 'Team work', 'score' => 80],
        ['name' => 'Leadership', 'score' => 95],
        ['name' => 'Management', 'score' => 85],
    ],
];

$workExperience = [
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
];

$diplomas = [
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
];

$portfolio = [
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
];

$references = [
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
];

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

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="index.php" method="post">
    <p>Введите имя: <input type="text" name="firstName" value="<?=$firstName?>"> Введите фамилию: <input type="text" name="lastName" value="<?=$lastName?>"></p>
    <p>Введите вашу дату рождения: <input type="text" name="dateBirth" value="<?=$dateBirth?>"></p>
    <p>Введите позицию: <input type="text" name="position" value="<?=$position?>"></p>
    <p>Введите информацию о себе:</p>
    <p><input type="text" name="aboutMe" value="<?=$aboutMe?>"></p>
    <hr>
    <h3>Введите профессиональные навыки: </h3>
    <p>Описание: <input type="text" name="<?='professionalSkills_description'?>" value="<?=$professionalSkills['description']?>"></p>
    <p>Навыки:</p>
    <?php foreach ($professionalSkills['skills'] as $index => $item): ?>
        Название: <input type="text" name="<?="professionalSkills_skills[$index][name]" ?>" value="<?=$item['name']?>">
        Уровень: <input type="text" name="<?="professionalSkills_skills[$index][score]"?>"  value="<?=$item['score']?>"><br><br>
    <?php endforeach ?>
    <hr>
    <h3>Введите персональные навыки: </h3>
    <p>Описание: <input type="text" name="<?='personalSkills_description'?>" value="<?=$personalSkills['description']?>"></p>
    <p>Навыки:</p>
    <?php foreach ($personalSkills['skills'] as $index => $item): ?>
        Название: <input type="text" name="<?="personalSkills_skills[$index][name]" ?>" value="<?=$item['name']?>">
        Уровень: <input type="text" name="<?="personalSkills_skills[$index][score]"?>"  value="<?=$item['score']?>"><br><br>
    <?php endforeach ?>
    <hr>
    <h3>Введите опыт работы:</h3>
    <?php foreach ($workExperience as $index => $item): ?>
        Компания: <input type="text" name="<?="workExperience[$index][company]" ?>" value="<?=$item['company']?>">
        Позиция: <input type="text" name="<?="workExperience[$index][position]"?>"  value="<?=$item['position']?>">
        Начальная дата: <input type="date" name="<?="workExperience[$index][start_date]"?>"  value="<?=$item['start_date']?>">
        Конечная дата: <input type="date" name="<?="workExperience[$index][end_date]"?>"  value="<?=$item['end_date']?>"><br><br>
        Описание: <input type="text" name="<?="workExperience[$index][description]"?>"  value="<?=$item['description']?>"><br><br><br>
    <?php endforeach ?>
    <hr>
    <h3>Введите информацию об образовании:</h3>
    <?php foreach ($diplomas as $index => $item): ?>
        Учебное заведение: <input type="text" name="<?="diplomas[$index][company]" ?>" value="<?=$item['company']?>">
        Специальность: <input type="text" name="<?="diplomas[$index][position]"?>"  value="<?=$item['position']?>">
        Дата окончания: <input type="text" name="<?="diplomas[$index][date]"?>"  value="<?=$item['date']?>"><br><br>
        Описание: <input type="text" name="<?="diplomas[$index][description]"?>"  value="<?=$item['description']?>"><br><br><br>
    <?php endforeach ?>
    <hr>
    <h3>Введите информацию для портфолио:</h3>
    <?php foreach ($portfolio['filter'] as $index => $item): ?>
        Data-filter: <input type="text" name="<?="portfolio_filter[$index][data_filter]" ?>" value="<?=$item['data_filter']?>">
        Class: <input type="text" name="<?="portfolio_filter[$index][class]"?>"  value="<?=$item['class']?>">
        Text: <input type="text" name="<?="portfolio_filter[$index][text]"?>"  value="<?=$item['text']?>"><br><br><br>
    <?php endforeach ?>
    <?php foreach ($portfolio['gallery'] as $index => $item): ?>
    Project title: <input type="text" name="<?="portfolio_gallery[$index][title]" ?>" value="<?=$item['title']?>">
    Project name: <input type="text" name="<?="portfolio_gallery[$index][text]"?>"  value="<?=$item['text']?>"><br><br>
    Filters:
        <?php foreach ($item['filters'] as $index_filters => $item_filters): ?>
            <input type="text" name="<?="portfolio_gallery[$index][filters][$index_filters]"?>"  value="<?=$item_filters?>">
        <?php endforeach ?>
    <br><br>
    Reference: <input type="text" name="<?="portfolio_gallery[$index][href]"?>"  value="<?=$item['href']?>">
    Image source: <input type="text" name="<?="portfolio_gallery[$index][src]"?>"  value="<?=$item['src']?>"><br><br><br>
    <?php endforeach ?>
    <hr>
    <h3>Введите информацию о ссылках:</h3>
    <?php foreach ($references as $index => $item): ?>
        Testimonial: <input type="text" name="<?="references[$index][testimonial]" ?>" value="<?=$item['testimonial']?>">
        Image: <input type="text" name="<?="references[$index][image]"?>"  value="<?=$item['image']?>">
        Person: <input type="text" name="<?="references[$index][person]"?>"  value="<?=$item['person']?>">
        Position: <input type="text" name="<?="references[$index][position]"?>"  value="<?=$item['position']?>"><br><br><br>
    <?php endforeach ?>
    <hr>
    <h3>Введите информацию о контактах:</h3>
    <?php foreach ($contacts as $index => $item): ?>
        Type: <input type="text" name="<?="contacts[$index][type]" ?>" value="<?=$item['type']?>"><br><br>
    <?php endforeach ?>
    <hr>
    <input type="submit" value="Отправить">
</form>
</body>
</html>