<?php

/**
 * @var modX $this->modx
 * @var modTemplateVar $this
 * @var array $params
 *
 * @package modx
 * @subpackage processors.element.tv.renders.mgr.input
 */
class modTemplateVarInputRenderMigxdb extends modTemplateVarInputRender {
    public function process($value, array $params = array()) {

        $namespace = 'migx';
        $this->modx->lexicon->load('tv_widget', $namespace . ':default');
        //$properties = isset($params['columns']) ? $params : $this->getProperties();
        $properties = $params;
        
        require_once dirname(dirname(dirname(dirname(__file__)))) . '/model/migx/migx.class.php';
        $this->migx = new Migx($this->modx,$properties);
        /* get input-tvs */
        $this->migx->loadLang();
        $this->migx->prepareGrid($params,$this,$this->tv);
        $grid = $this->migx->getGrid();
        $gridfile = $this->migx->config['templatesPath'] . '/mgr/grids/' . $grid . '.grid.tpl';
        $this->setPlaceholder('grid', $this->migx->replaceLang($this->modx->controller->fetchTemplate($gridfile)));

        $windowfile = $this->migx->config['templatesPath'] . 'mgr/updatewindow.tpl';
        $this->setPlaceholder('updatewindow', $this->migx->replaceLang($this->modx->controller->fetchTemplate($windowfile)));
        $this->setPlaceholder('i18n_migx_loadgrid', $this->migx->migxlang['migx.loadgrid']);        
        
         
    }
    public function getTemplate() {
        
        $path = 'components/migx/';
        $corePath = $this->modx->getOption('migx.core_path', null, $this->modx->getOption('core_path') . $path);        
        return $corePath . 'elements/tv/migxdb.tpl';
    }
}
return 'modTemplateVarInputRenderMigxdb';
