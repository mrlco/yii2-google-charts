<?php
namespace mrlco\googlecharts;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;

/**
 * A wrapper for google charts in Yii2
 *
 * @see https://github.com/mrlco/yii2-google-charts
 * @author Mehran Barzandeh <admin@mrlco.ir>
 */
class GoogleCharts extends Widget
{
    /**
     * @var string $jsApi Google charts js file.
     */
    public $jsApi = 'https://www.google.com/jsapi';

    /**
     * @var string $containerId the visualization container Id to render charts in.
     */
    public $containerId = null;

    /**
     * @var string $visualization the type of visualization. for example: PieChart
     * @see https://google-developers.appspot.com/chart/interactive/docs/gallery
     */
    public $visualization;

    /**
     * @var string $packages the type of packages, default is corechart
     * @see https://google-developers.appspot.com/chart/interactive/docs/gallery
     */
    public $packages = 'corechart';

    /**
     * @var string $loadVersion the version of google charts. Frozen chart versions are identified by number.
     * @see https://google-developers.appspot.com/chart/interactive/docs/basic_load_libs#frozen-versions
     */
    public $loadVersion = "1";

    /**
     * @var array $data the data to configure visualization
     * @see https://google-developers.appspot.com/chart/interactive/docs/datatables_dataviews#arraytodatatable
     */
    public $data = [];

    /**
     * @var array $options additional configuration options
     * @see https://google-developers.appspot.com/chart/interactive/docs/customizing_charts
     */
    public $options = [];

    /**
     * @var string $scriptAfterArrayToDataTable additional javascript to execute after arrayToDataTable is called
     */
    public $scriptAfterArrayToDataTable = '';

    /**
     * @var array $htmlOption the HTML tag attributes configuration
     */
    public $htmlOptions = [];

    public function run()
    {
        $id = $this->getId();
        if (isset($this->options['id']) and !empty($this->options['id'])) {
            $id = $this->options['id'];
        }
        // if no container is set, it will create one
        if ($this->containerId === null) {
            $this->htmlOptions['id'] = 'div-chart' . $id;
            $this->containerId = $this->htmlOptions['id'];
            echo '<div ' . Html::renderTagAttributes($this->htmlOptions) . '></div>';
        }
        $this->registerClientScript($id);
    }

    /**
     * Registers required client scripts
     * @param string $id the visualization's (chart) identifier
     */
    public function registerClientScript($id)
    {
        $jsData = Json::encode($this->data);
        $jsOptions = Json::encode($this->options);
        $script = '
			google.setOnLoadCallback(drawChart' . $id . ');
			var ' . $id . '=null;
			function drawChart' . $id . '() {
				var data = google.visualization.arrayToDataTable(' . $jsData . ');
				' . $this->scriptAfterArrayToDataTable . '
				var options = ' . $jsOptions . ';
				' . $id . ' = new google.visualization.' . $this->visualization . '(document.getElementById("' . $this->containerId . '"));
				' . $id . '.draw(data, options);
			}';
        $view = $this->getView();
        $view->registerJsFile($this->jsApi, ['position' => View::POS_HEAD]);
        $view->registerJs('google.load("visualization", "' . $this->loadVersion . '", {packages:["' . $this->packages . '"]});',
            View::POS_HEAD, __CLASS__ . '#' . $id);
        $view->registerJs($script, View::POS_HEAD, $id);
    }
}
