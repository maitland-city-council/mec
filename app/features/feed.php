<?php
/** no direct access **/
defined('_MECEXEC_') or die();

/**
 * Webnus MEC feed class.
 * @author Webnus <info@webnus.biz>
 */
class MEC_feature_feed extends MEC_base
{
    /**
     * Constructor method
     * @author Webnus <info@webnus.biz>
     */
    public function __construct()
    {
        // Import MEC Factory
        $this->factory = $this->getFactory();
        
        // Import MEC Main
        $this->main = $this->getMain();
        
        // Import MEC Feed
        $this->feed = $this->getFeed();
        
        // MEC Post Type Name
        $this->PT = $this->main->get_main_post_type();
    }
    
    /**
     * Initialize feed feature
     * @author Webnus <info@webnus.biz>
     */
    public function init()
    {
        remove_all_actions('do_feed_rss2');
        $this->factory->action('do_feed_rss2', array($this, 'rss2'), 10, 1);
    }
    
    /**
     * Do the feed
     * @author Webnus <info@webnus.biz>
     * @param string $for_comments
     */
    public function rss2($for_comments)
    {
        $rss2 = MEC::import('app.features.feed.rss2', true, true);
        
        if(get_query_var('post_type') == $this->PT)
        {
            // Fetch Events
            $this->events = $this->fetch();
            
            // Include Feed template
            include_once $rss2;
        }
        else do_feed_rss2($for_comments); // Call default function
    }
    
    /**
     * Returns the events
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function fetch()
    {
        $EO = new MEC_skin_list(); // Events Object
        $EO->initialize(array('sk-options'=>array('list'=>array('limit'=>get_option('posts_per_rss', 12)))));
        $EO->search();
        
        return $EO->fetch();
    }
}