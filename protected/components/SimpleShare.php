<?php
class SimpleShare extends CWidget
{
    /**
     * Site Name
     * @var string
     * defaults to Yii::app()->name
     */
    public $siteName = '';
 
    /**
     * Site Administrator's Facebook ID
     * @var string
     */
    public $fbSiteAdmin = 'XXXXXXXXXXXXXX';
 
    /**
     * URL of the page
     * @var string
     * defaults to the current page URL
     */
    public $pageUrl = '';
	/*public $pageUrl = '';
	public $pageUrl = '';
	public $pageUrl = '';
 */
    /**
     * Title of the page
     * @var string
     */
    public $pageTitle = '';
 
    /**
     * Type of the Page : eg. website, article, ... etc.
     * @var string
     * defaults to 'article'
     */
    public $pageType = '';
 
    /**
     * Description of the page
     * @var string
     */
    public $pageDescription = '';
 
    /**
     * Image(s) of the page
     * @var mixed
     * can be a single string or array of strings
     * defaults $this->defaultPageImage
     */
    public $pageImages = '';
 
    /**
     * Default image of the page
     * @var string
     */
    public $defaultPageImage = '/images/fb/site-logo.jpg';
 
    /**
     * Show Comments
     * @var type boolean
     * defaults to true
     */
    public $showComments = true;
 
    /**
     * Initialization
     * @see CWidget::init()
     */
    public function init()
    {
        parent::init();
 
        // Site Name
        if ($this->siteName == '')
        {
            $this->siteName = Yii::app()->name;
        }
 
        // base URL
        $baseUrl = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl;
        // URL of the page
        if ($this->pageUrl == '')
        {
            $this->pageUrl = $baseUrl . '/' . Yii::app()->request->pathInfo;
        }
 
        // Type of the page
        if ($this->pageType == '')
        {
            $this->pageType = 'article';
        }
 
        // Set opengraph meta tags
        $cs = Yii::app()->getClientScript();
        $cs->registerMetaTag($this->siteName, NULL, NULL, array('property'=>'og:site_name'));
        $cs->registerMetaTag($this->fbSiteAdmin, NULL, NULL, array('property'=>'fb:admins'));
        $cs->registerMetaTag($this->pageUrl, NULL, NULL, array('property' =>'og:url'));
        $cs->registerMetaTag($this->pageTitle, NULL, NULL, array('property'=>'og:title'));
        $cs->registerMetaTag($this->pageType, NULL, NULL, array('property'=>'og:type'));
        // Description of the page
        if ($this->pageDescription != "")
        {
            $cs->registerMetaTag($this->pageDescription, NULL, NULL, array('property'=>'og:description'));
        }
        // Image(s) of the page
        if (is_array($this->pageImages))
        {
            if (count($this->pageImages) == 0)
            {
                $this->pageImages = $this->defaultPageImage;
            }
            foreach($this->pageImages as $image)
            {
                $cs->registerMetaTag($baseUrl . $image, NULL, NULL, array('property'=> 'og:image'));
            }
        }
        else
        {
            if ($this->pageImages == "")
            {
                $this->pageImages = $this->defaultPageImage;
            }
            $cs->registerMetaTag($baseUrl . $this->pageImages, NULL, NULL, array('property'=> 'og:image'));
        }
 
        // javascript for facebook
        // 'ja_JP' should be replaced according to you locale
        $fb_js =<<< EOS
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "https://connect.facebook.net/ja_JP/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
EOS;
        $cs->registerScript('fb-jssdk', $fb_js, CClientScript::POS_BEGIN);
        $cs->registerScriptFile('//platform.twitter.com/widgets.js', CClientScript::POS_HEAD);
    }
 
    /**
     * Display the widget
     * @see CWidget::run()
     */
    public function run()
    {
        echo '<div class="sns-share-buttons">' . "\n";
 
        // google plusone
        echo '<script type="text/javascript" src="https://apis.google.com/js/plusone.js">{lang: \'ja\'}</script>' . "\n";
        /* replace 'ja' with your language */
        echo '<div class="google-plus" style="float:right">' . "\n";
        echo '<g:plusone size="medium" href="' . $this->pageUrl . '"></g:plusone>' . "\n";
        echo '</div>' . "\n";
 
        // twitter
        $tw_text = $this->siteName . ' - ' . $this->pageTitle;
        if ( $this->pageDescription != '')
        {
            $tw_text .= ' : ' . $this->pageDescription;
        }
        echo '<div class="tweet-button" style="float:right">' . "\n";
        echo '<a href="https://twitter.com/share" '
                . 'class="twitter-share-button" '
                . 'data-url="' . $this->pageUrl . '" '
                . 'data-text="' . $tw_text . '" '
                . 'data-count="horizontal">Tweet</a>' . "\n";
        echo '</div>' . "\n";
 
        // facebook
        echo '<div class="fb-like" '
                . 'data-href="' . $this->pageUrl . '" '
                . 'data-send="true" '
                . 'data-width="500" '
                . 'data-show-faces="false"></div>' . "\n";
        if ($this->showComments)
        {
            echo '</div>' . "\n";
            echo '<div class="facebook-comments">' . "\n";
            echo '<div class="fb-comments" '
                    . 'data-href="' . $this->pageUrl . '" '
                    . 'data-num-posts="4" '
                    . 'data-width="600"></div>' . "\n";
        }
        echo '</div>' . "\n";
    }
}