<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<script type="text/javascript">
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
        create : function (tag, attr) {
            var el = document.createElement(tag);
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
            return el;
        },
        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('<?php echo $this->respondId(); ?>'),
                input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];
            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });
                form.appendChild(input);
            }
            input.setAttribute('value', coid);
            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });
                response.parentNode.insertBefore(holder, response);
            }
            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';
            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }
            return false;
        },
        cancelReply : function () {
            var response = this.dom('<?php echo $this->respondId(); ?>'),
            holder = this.dom('comment-form-place-holder'),
            input = this.dom('comment-parent');
            if (null != input) {
                input.parentNode.removeChild(input);
            }
            if (null == holder) {
                return true;
            }
            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
</script>
<?php
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';

    if ($comments->url) {
        $author = '<a href="' . $comments->url . '" target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
?>

<li id="li-<?php $comments->theId(); ?>" class="<?php
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div id="<?php $comments->theId(); ?>" class="comment-body">
        <?php
            $host = 'https://secure.gravatar.com';
            $url = '/avatar/';
            $size = '80';
            $rating = Helper::options()->commentsAvatarRating;
            $hash = md5(strtolower($comments->mail));
            $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=';
        ?>

        <img class="avatar" src="<?php echo $avatar ?>" alt="<?php echo $comments->author; ?>" width="<?php echo $size ?>" height="<?php echo $size ?>" />
        <div class="comment-main">
            <?php $comments->content(); ?>
            <div class="comment-meta">
                <span class="comment-author"><?php $comments->author(); ?></span>
                <time class="comment-time"><?php echo getDayAgo($comments->date); ?></time>
                <span class="comment-reply"><?php $comments->reply(); ?></span>
            </div>
        </div>
    </div>
    <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
</li>
<?php } ?>

<div id="comments" class="cf">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
    <h2 class="comments-title"><?php $this->commentsNum(_t('暂无评论'), _t('仅有 1 条评论'), _t('已有 %d 条评论')); ?></h2>

    <?php $comments->listComments(); ?>

    <?php $comments->pageNav('&laquo;', '&raquo;'); ?>

    <?php endif; ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>

        </div>
        <span class="response sr-only"><?php _e('发表新评论'); ?></span>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
            <p><?php _e('已登入: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
            <?php else: ?>
            <input type="text" name="author" maxlength="12" id="author" class="form-control" placeholder="<?php _e('称呼 *'); ?>" value="" required>
            <input type="email" name="mail" id="mail" class="form-control" placeholder="<?php _e('电子邮箱 *'); ?>" value="" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
            <input type="url" name="url" id="url" class="form-control" placeholder="<?php _e('网址(http://)'); ?>" value="" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
            <?php endif; ?>
            <textarea name="text" id="textarea" class="form-control" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('misubmit').click();return false};" placeholder="<?php _e('在这里输入你的评论(Ctrl/Cmd+Enter也可以提交)...'); ?>" required ><?php $this->remember('text',false); ?></textarea>
            <button type="submit" class="submit" id="misubmit"></button>
        </form>
    </div>
    <?php endif; ?>
</div>