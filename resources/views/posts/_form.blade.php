<div class="form-group">
  <label>Title</label>
  <input type="text" name="title" class="form-control"
         value="{{ old('title', $post->title ?? 'This article is about the central religious text of Islam') }}"/>
</div>

<div class="form-group">
  <label>Content</label>
  <input type="text" name="content" class="form-control"
         value="{{ old('content', $post->content ?? 'Allah - there is no deity except Him the Ever-Living the Sustainer of [all] existence Neither drowsiness overtakes Him nor sleep To Him belongs whatever is in the heavens and whatever is on the earth Who is it that can intercede with Him except by His permission He knows what is [presently] before them and what will be after them and they encompass not a thing of His knowledge except for what He wills His Kursi extends over the heavens and the earth and their preservation tires Him not And He is the Most High the Most Great') }}"/>
</div>
<div class="form-group">
  <label>Thumbnail</label>
  <input type="file" name="thumbnail" class="form-control-file"/>
</div>
<x-errors/>