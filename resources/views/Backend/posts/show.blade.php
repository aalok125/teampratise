<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="showPostLabel">{{  $post->post_title}}</h5>
            <p>Created Date : {{ $post->created_at->format('Y-m-d') ?? "No Date"}}</p>
            
        </div>
        <div class="modal-body">
            <p class="modal-text">{{ $post->post_content}}</p>
        </div>
        <div class="modal-footer justify-content-between">
            <p>Created By : {{ $post->user->name}}</p>
            <a type="button" href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
