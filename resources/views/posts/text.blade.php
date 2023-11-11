<iframe name="tar" frameborder="0" id="tar" style="display:none">
</iframe>

    <form target="tar" action="{{route('post.text.update')}}" method="post">
        @csrf
        @method("PATCH")
        <input type="text" value="{{$text->id}}" name="text_id">
        <input type="text" value="{{$text->post_id}}" name="post_id" hidden>
        
        <textarea name="PostText"></textarea>
        <input type="submit" value="отправить">
    </form>


    

    
