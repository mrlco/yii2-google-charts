# yii2-google-charts
A wrapper for Google charts in Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require mrlco/yii2-google-charts "*"
```

or add

```
"mrlco/yii2-google-charts": "*"
```

to the require section of your `composer.json` file.


Usage
-----

For more information see [Google Charts](https://developers.google.com/chart/interactive/docs/quick_start)

Remember to include the GoogleCharts.php where ever you need:
```php
    use mrlco\googlecharts\GoogleCharts;
```
And in your view:

```php
<?php
/* For more info on usage of any type of charts, see the google charts documentation */

// PieChart
echo GoogleCharts::widget([
    'visualization' => 'PieChart',
    'containerId' => 'chart-container',
    'data' => [
        ['Task', 'Hours per Day'],
        ['Work', 11],
        ['Eat', 2],
        ['Commute', 2],
        ['Watch TV', 2],
        ['Sleep', 7]
    ],
    'options' => ['title' => 'My Daily Activity']
]);

// LineChart
echo GoogleCharts::widget([
    'visualization' => 'LineChart',
    'containerId' => 'chart-container',
    'data' => [
        ['Task', 'Hours per Day'],
        ['Work', 11],
        ['Eat', 2],
        ['Commute', 2],
        ['Watch TV', 2],
        ['Sleep', 7]
    ],
    'options' => ['title' => 'My Daily Activity']
]);

// Another LineChart example
echo GoogleCharts::widget([
    'visualization' => 'LineChart',
    'containerId' => 'chart-container',
    'data' => [
        ['Year', 'Sales', 'Expenses'],
        ['2004', 1000, 400],
        ['2005', 1170, 460],
        ['2006', 660, 1120],
        ['2007', 1030, 540],
    ],
    'options' => [
        'title' => 'My Company Performance',
        'titleTextStyle' => ['color' => '#FF0000'],
        'vAxis' => [
            'title' => 'Vertical Axis',
            'gridlines' => [
                'color' => 'transparent' //set grid line transparent
            ]
        ],
        'hAxis' => ['title' => 'Horizontal Aixs'],
        'curveType' => 'function', //smooth curve or not
        'legend' => ['position' => 'bottom'],
    ]
]);

// ScatterChart
echo GoogleCharts::widget([
    'visualization' => 'ScatterChart',
    'containerId' => 'chart-container',
    'data' => [
        ['Sales', 'Expenses', 'Quarter'],
        [1000, 400, '2015 Q1'],
        [1170, 460, '2015 Q2'],
        [660, 1120, '2015 Q3'],
        [1030, 540, '2015 Q4'],
    ],
    'scriptAfterArrayToDataTable' => "data.setColumnProperty(2, 'role', 'tooltip');",
    'options' => [
        'title' => 'Expenses vs Sales',
    ]
]);

// Gauge
echo GoogleCharts::widget([
    'visualization' => 'Gauge',
    'containerId' => 'chart-container',
    'packages' => 'gauge',
    'data' => [
        ['Label', 'Value'],
        ['Memory', 80],
        ['CPU', 55],
        ['Network', 68],
    ],
    'options' => [
        'width' => 400,
        'height' => 120,
        'redFrom' => 90,
        'redTo' => 100,
        'yellowFrom' => 75,
        'yellowTo' => 90,
        'greenFrom' => 50,
        'greenTo' => 75,
        'minorTicks' => 5
    ]
]);

?>
```
