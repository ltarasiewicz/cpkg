<?php

class CpkgPost extends TimberPost
{
    public function types($fieldId)
    {
        return get_post_meta($this->ID, 'wpcf-' . $fieldId, true);
    }
}

