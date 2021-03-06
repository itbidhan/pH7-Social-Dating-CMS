<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Core / Class / Design
 */
namespace PH7;

use PH7\Framework\Pattern\Statik, PH7\Framework\Mvc\Router\Uri;

class CommentDesignCore
{
    /**
     * Import the trait to set the class static.
     * The trait sets constructor/clone private to prevent instantiation.
     */
    use Statik;

    /**
     * Get the link to comments.
     *
     * @param integer $iId
     * @param string $sTable
     * @return void
     */
    public static function link($iId, $sTable)
    {
        $oCommentModel = new CommentCoreModel;
        $iCommentNumber = $oCommentModel->total($iId, $sTable);
        unset($oCommentModel);

        echo '<p class="s_marg"><a class="underline" href="', Uri::get('comment','comment','add',"$sTable,$iId"), '">', t('Add a comment'), '</a>';

        if ($iCommentNumber > 0) {
            $sCommentTxt = nt('Read Comment', 'Read the Comments', $iCommentNumber);
            echo ' | <a class="underline" href="', Uri::get('comment','comment','read',$sTable.','.$iId), '">', $sCommentTxt, ' (', $iCommentNumber, ')</a>';
            echo ' <a href="', Uri::get('xml','rss','xmlrouter','comment-'.$sTable.','.$iId), '">';
            echo '<img src="', PH7_URL_STATIC, PH7_IMG, 'icon/small-feed.png" alt="', t('RSS Feed'), '" />';
            echo '</a>';
        }
        echo '</p>';
    }
}
