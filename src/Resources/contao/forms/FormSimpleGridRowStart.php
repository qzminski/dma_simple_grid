<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DMA;
/**
 * SimpleGrid row start content element
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */
class FormSimpleGridRowStart extends \Contao\Widget
{

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'form_dma_simplegrid_rowstart';


    /**
     * Do not validate
     */
    public function validate()
    {
        return;
    }


    /**
     * Parse the template file and return it as string
     *
     * @param array $arrAttributes An optional attributes array
     *
     * @return string The template markup
     */
    public function parse($arrAttributes=null)
    {
        $request = \Contao\System::getContainer()->get('request_stack')->getCurrentRequest();

        if ($request && \Contao\System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request)) {
            /** @var \Contao\Contao\BackendTemplate|object $objTemplate */
            $objTemplate = new \Contao\Contao\BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FFL']['dma_simplegrid_row_start'][0]) . ' ###';

            return $objTemplate->parse();
        }

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? false) && ($GLOBALS['DMA_SIMPLEGRID_CONFIG'][($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? null)] ?? false))
        {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        }
        else
        {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_CONFIG']['DMA_SIMPLEGRID_FALLBACK']];
        }

        $strAdditionalClasses = $arrConfigData['config']['row-class'];

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'] ?? false) && $arrConfigData['config']['additional-classes']['row'] && $this->dma_simplegrid_additionalrowclasses)
        {
            $arrAdditionalClasses = \Contao\StringUtil::deserialize($this->dma_simplegrid_additionalrowclasses, true);

            if (sizeof($arrAdditionalClasses) > 0)
            {
                foreach ($arrAdditionalClasses as $strClassKey)
                {
                    $strAdditionalClasses .= " " . $strClassKey;
                }
            }
        }

        $this->strPrefix = "" . $strAdditionalClasses;

        return parent::parse($arrAttributes);
    }


    /**
     * Generate the widget and return it as string
     *
     * @return string The widget markup
     */
    public function generate()
    {

        return "";
    }
}
