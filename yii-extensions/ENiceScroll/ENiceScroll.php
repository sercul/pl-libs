<?php
/**
 * Widget for JavaScript plugin from http://areaaperta.com/nicescroll/ by InuYaksa.
 *
 * Wrapper by Mario DE WEERD - Ynamics
 *
 * @example
 *
 *  When 'ext' points to the extension directory,
 *  '$this' refers to a CController or other object with 'widget' method.
 *  Typical use: inside a view.
 *
 *  $cmmentId="id-of-zone-to-scroll";
 *  $this->widget(
 *      "ext.ENiceScroll.ENiceScroll",
 *      array(
 *          'selector'=>"#{$commentId}",
 *          'preservenativescrolling'=>false,
 *          'cursorwidth'=>20,
 *          'cursoropacitymax'=>'0.7'
 *          )
 *      );
 *
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT The MIT License
 * @author Mario DE WEERD
 */
class ENiceScroll extends CWidget
{
    const CALLBACK_OPTION = 'callback';

    public $callback;

    /**
     * jQuery DOM Selector to which this widget applies.
     *
     * Default: .nicescroll
     */
    public $selector=".nicescroll";

    /**
     * jQuery DOM Selector for wrapper.
     *
     * Default: (empty)
     */
    public $wrapperSelector;
    /**
     * change cursor color in hex, default is "#000000"
     */
    public $cursorcolor;

    /**
     * change opacity very cursor is inactive (scrollabar "hidden" state),
     * range from 1 to 0, default is 0 (hidden)
     */
    public $cursoropacitymin;

    /**
     * change opacity very cursor is active (scrollabar "visible" state),
     * range from 1 to 0, default is 1 (full opacity)
     */
    public $cursoropacitymax;

    /**
     * cursor width in pixel, default is 5 (you can write "5px" too)
     */
    public $cursorwidth;

    /**
     * css definition for cursor border, default is "1px solid #fff"
     */
    public $cursorborder;

    /**
     * border radius in pixel for cursor, default is "4px"
     */
    public $cursorborderradius;

    /**
     * change z-index for scrollbar div, default value is 9999
     */
    public $zindex;

    /**
     * scrolling speed, default value is 60
     */
    public $scrollspeed;

    /**
     * scrolling speed with mouse wheel, default value is 40 (pixel)
     */
    public $mousescrollstep;

    /**
     * enable cursor-drag scrolling like touch devices in desktop computer
     * (default:false)
     */
    public $touchbehavior;

    /**
     * use hardware accelerated scroll when supported (default:true)
     */
    public $hwacceleration;

    /**
     * enable zoom for box content (default:false)
     */
    public $boxzoom;

    /**
     * (only when boxzoom=true) zoom activated when double click on box
     * (default:true)
     */
    public $dblclickzoom;

    /**
     * (only when boxzoom=true and with touch devices) zoom activated when
     * pitch out/in on box (default:true)
     */
    public $gesturezoom;

    /**
     * display "grab" icon for div with touchbehavior = true, (default:true)
     */
    public $grabcursorenabled;

    /**
     * how hide the scrollbar works, true=default / "cursor" = only cursor
     * hidden / false = do not hide
     */
    public $autohidemode;

    /**
     * change css for rail background, default is ""
     */
    public $background;

    /**
     * autoresize iframe on load event (default:true)
     */
    public $iframeautoresize;

    /**
     * set the minimum cursor height in pixel (default:20)
     */
    public $cursorminheight;

    /**
     * you can scroll native scrollable areas with mouse, bubbling mouse wheel
     * event (default:false).
     *
     * Default set to 'false' because this is an expected behavior IMHO.
     */
    public $preservenativescrolling=false;

    /**
     * you can add offset top/left for rail position (default:false)
     */
    public $railoffset;

    /**
     * enable scroll bouncing at the end of content as mobile-like (only hw
     * accell) (default:false)
     */
    public $bouncescroll;

    /**
     * enable page down scrolling when space bar has pressed (default:true)
     */
    public $spacebarenabled;

    /**
     * set padding for rail bar (default:{top:0,right:0,left:0,bottom:0})
     */
    public $railpadding;

    /**
     * for chrome browser, disable outline (orange hightlight) when selecting
     * a div with nicescroll (default:true)
     */
    public $disableoutline;

    /**
     * nicescroll can manage horizontal scroll (default:true)
     */
    public $horizrailenabled;

    /**
     * alignment of vertical rail (defaul:"right")
     */
    public $railalign;

    /**
     * alignment of horizontal rail (defaul:"bottom")
     */
    public $railvalign;

    /**
     * nicescroll can use css translate to scroll content (default:true)
     */
    public $enabletranslate3d;

    /**
     * nicescroll can manage mouse wheel events (default:true)
     */
    public $enablemousewheel;

    /**
     * nicescroll can manage keyboard events (default:true)
     */
    public $enablekeyboard;

    /**
     * scroll with ease movement (default:true)
     */
    public $smoothscroll;

    /**
     * click on rail make a scroll (default:true)
     */
    public $sensitiverail;

    /**
     * can use mouse caption lock API (same issue on object dragging)
     * (default:true)
     */
    public $enablemouselockapi;

    /**
     * set fixed height for cursor in pixel (default:false)
     */
    public $cursorfixedheight;

    /**
     * set the delay in microseconds to fading out scrollbars (default:400)
     */
    public $hidecursordelay;

    /**
     * dead zone in pixels for direction lock activation (default:6)
     */
    public $directionlockdeadzone;

    /**
     * detect bottom of content and let parent to scroll, as native scroll
     * does (default:true)
     */
    public $nativeparentscrolling;

    /**
     * enable auto-scrolling of content when selection text (default:true)
     */
    public $enablescrollonselection;


    /**
     * When true, cache the code. Default: false.
     *
     * When enabled, make sure that the cacheid is unique with regards
     * to the widget configuration.
     * Caching avoids some time spent in analyzing the parameters.
     */
    public $cache=false;

    /**
     * cacheid, used for caching. Default: "default"
     */
    public $cacheid="default";

    /**
     * Expire time in seconds for cache. Default: 3600
     */
    public $cacheexpire=3600;

    /**
     * (non-PHPdoc)
     * @see CWidget::run()
     */
    function run()
    {
        // Everything is done during initialisation.
    }

    /**
     * Initializes everything
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        $this->registerScripts();
    }

    /**
     * Registers the JS and CSS Files
     *
     * @return void
     */
    protected function registerScripts()
    {
        /* Note: this code is more or less generic and used
         * in a similar way accross extension.
         * Hence the apparent overkill. */

        /* @var $am CAssetManager */
        $am=Yii::app()->assetManager;
        $path=$ap=$am->publish(
                __DIR__ . DIRECTORY_SEPARATOR . "assets");
        $cs=Yii::app()->clientScript;
        /* This extension requires jQuery */
        $cs->registerCoreScript('jquery');
        /* Set the cache id */
        $cacheid=__CLASS__.Yii::app()->language.$this->cacheid;
        /* Register CSS and JS files */
        $cssFiles=array();
        $jsFiles=array('jquery.nicescroll.min.js');

        foreach($cssFiles as $f) {
            $cs->registerCssFile("$path/$f");
        }
        foreach($jsFiles as $j) {
            $cs->registerScriptFile("$path/$j");
        }
        $js=false;
        if($this->cache) {
            $js=Yii::app()->cache->get($cacheid);
        }
        if($js === false) {
            /* $js is false if there is no cache.  Hence, compute. */

            /* List of options allowed for the JavaScript plugin. */
            $optionList=array(
                    'cursorcolor',
                    'cursoropacitymin',
                    'cursoropacitymax',
                    'cursorwidth',
                    'cursorborder',
                    'cursorborderradius',
                    'zindex',
                    'scrollspeed',
                    'mousescrollstep',
                    'touchbehavior',
                    'hwacceleration',
                    'boxzoom',
                    'dblclickzoom',
                    'gesturezoom',
                    'grabcursorenabled',
                    'autohidemode',
                    'background',
                    'iframeautoresize',
                    'cursorminheight',
                    'preservenativescrolling',
                    'railoffset',
                    'bouncescroll',
                    'spacebarenabled',
                    'railpadding',
                    'disableoutline',
                    'horizrailenabled',
                    'railalign',
                    'railvalign',
                    'enabletranslate3d',
                    'enablemousewheel',
                    'enablekeyboard',
                    'smoothscroll',
                    'sensitiverail',
                    'enablemouselockapi',
                    'cursorfixedheight',
                    'hidecursordelay',
                    'directionlockdeadzone',
                    'nativeparentscrolling',
                    'enablescrollonselection',
                    'callback'
            );

            /* Build the options array for the JavaScript plugin. */
            $options=array();
            foreach($optionList as $option) {
                if(isset($this->$option)) {
                    if ( $option != self::CALLBACK_OPTION ) {
                        $options[$option]=$this->$option;
                    }
                }
            }

            // JavaScript options to embed in function.
            if(count($options)) {
                $jsOpt=CJavaScript::encode($options);
            } else {
                $jsOpt='';
            }

            // Nice scroll may refer to a wrapper, this changes the setup signature. */
            if(isset($this->wrapperSelector)) {
                $js.="jQuery('{$this->selector}').niceScroll('{$this->wrapperSelector}',{$jsOpt});";
            } else {
                $js.="jQuery('{$this->selector}').niceScroll({$jsOpt});";
            }
            if(!empty($this->callback)) {
                //@TODO Add callback function
            }
            if($this->cache)
                Yii::app()->cache->set($cacheid, $js, $this->cacheexpire);
        }
        $cs->registerScript($cacheid,$js,CClientScript::POS_READY);
   }
}

