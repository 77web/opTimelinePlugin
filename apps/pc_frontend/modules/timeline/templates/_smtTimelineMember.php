<?php use_helper('opUtil', 'Javascript', 'opAsset') ?>
<script type="text/javascript">
//<![CDATA[
var gorgon = {
      'member_id': <?php echo $id; ?>,
    };
//]]>
</script>
<?php op_smt_use_stylesheet('/opTimelinePlugin/css/jquery.colorbox.css') ?>
<?php op_smt_use_stylesheet('/opTimelinePlugin/css/timeline-smartphone.css', 'last') ?>
<?php op_smt_use_javascript('/opTimelinePlugin/js/jquery.colorbox.js', 'last') ?>
<?php op_smt_use_javascript('/opTimelinePlugin/js/jquery.timeline.js', 'last') ?>
<?php op_smt_use_javascript('/opTimelinePlugin/js/timeline-loader-smartphone.js', 'last') ?>

<script id="timelineTemplate" type="text/x-jquery-tmpl">
        <div class="timeline-post">
          <a name="timeline-${id}"></a>
          <div class="timeline-post-member-image">
            <a href="${member.profile_url}"><img src="${member.profile_image}" alt="member-image" width="23" /></a>
          </div>
          <div class="timeline-post-content">
            <div class="timeline-member-name">
              <a href="${member.profile_url}">{{if member.screen_name}} ${member.screen_name} {{else}} ${member.name} {{/if}}</a>
            </div>
            <div class="timeline-post-body" id="timeline-body-context-${id}">
              {{html body_html}}
            </div>
          </div>

          <div class="timeline-post-control">
            <a href="#timeline-${id}" class="timeline-comment-link">コメントする</a>
          </div>

          <div class="timeline-post-comments" id="commentlist-${id}">

            <div id="timeline-post-comment-form-${id}" class="timeline-post-comment-form">
            <input class="timeline-post-comment-form-input" type="text" data-timeline-id="${id}" id="comment-textarea-${id}" /><button data-timeline-id="${id}" class="btn btn-primary btn-mini timeline-comment-button">投稿</button>
            </div>
            <div id="timeline-post-comment-form-loader-${id}" class="timeline-post-comment-form-loader">
              <?php echo op_image_tag('ajax-loader.gif', array()) ?>
            </div>
          </div>
        </div>
</script>

<script id="timelineCommentTemplate" type="text/x-jquery-tmpl">
            <div class="timeline-post-comment">

              <div class="timeline-post-comment-member-image">
                <a href="${member.profile_url}"><img src="${member.profile_image}" alt="" width="23" /></a>
              </div>
              <div class="timeline-post-comment-content">
                <div class="timeline-post-comment-name-and-body">
                <a href="${member.profile_url}">{{if member.screen_name}} ${member.screen_name} {{else}} ${member.name} {{/if}}</a>
                <span class="timeline-post-comment-body">
                {{html body_html}}
                </span>
                </div>
              </div>
              <div class="timeline-post-comment-control">
              ${created_at}
              </div>
            </div>
</script>

<div class="row">
  <div class="gadget_header span12"><?php if ($member): ?><?php echo $member->getName(); ?>さんのタイムライン<?php else: ?>タイムライン<?php endif; ?></div>
</div>
<?php if ($member): ?>
<?php if ($sf_user->getMemberId() === $member->getId()): ?>
<a href="<?php echo url_for('@homepage'); ?>member/config?category=timelineScreenName">■スクリーンネーム設定画面</a><br />
<?php endif; ?>
<?php endif; ?>

<div id="timeline-list" class="span12" data-post-baseurl="<?php echo url_for('@homepage'); ?>" data-last-id="" data-loadmore-id="" style="margin-left: 0px;">
</div>
<div id="timeline-list-loader" class="row span12 center show" style="margin-top: 20px; margin-bottom: 20px;">
<?php echo op_image_tag('ajax-loader.gif', array('absolute' => true)) ?>
</div>
<div id="gorgon-submit" data-post-csrftoken="<?php echo $token; ?>" data-post-baseurl="<?php echo url_for('@homepage'); ?>"></div>
<div class="row">
  <button class="span12 btn small" id="gorgon-loadmore">もっと読む</button>
</div>

