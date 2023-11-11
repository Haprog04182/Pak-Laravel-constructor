@extends('layouts.app')

@section('links')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        table,
        table * {
            border: 2px solid black;
            min-width: 25px;
            min-height: 1em;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endsection

@section('content')
    <h1>creator</h1>

    <form action="{{ route('courses.store') }}" method="POST" id="courseForm">
        @csrf
        <input type="text" name="title" id="titleCourse" list="courseList">
        <datalist id="courseList">
            @foreach (App\Models\Course::all() as $course)
                <option value="{{ $course->title }}"></option>
            @endforeach
        </datalist>
        <input type="button" value="sub" id="subCourse">
    </form>

    <form action="{{ route('lessons.store') }}" method="post">
        @csrf
        <input type="text" name="title" id="titleLesson" value="" list="lessonList">
        <datalist id="lessonList">

        </datalist>
        <input type="button" value="sub" id="subLes">
    </form>



    <table>
        <tbody>
            <tr id="adder">
                <td><button id="AddRow">AddRow</button></td>
            </tr>


        </tbody>


    </table>

    <button>submit</button>
<script>
        class pageData {
            constructor(){
                this.PostButtons = [{name: Text, url: '{!! route('post.text.store') !!}'}];
                this.token = `${$('input[name="_token"]').val()}`
            }
        
            setId(id) {
                this.id = id;
            }
            //lesons set get 
            setLessons(res){
                page.lessons = res;
                page.lessons.map((value) => {
                    $('#lessonList').append(`<option>${value.title}</option>`);
                });
            }
            getLessons() {
                let FormData = {
                    course_id: page.course_id
                }
                $.ajax({
                    url: `{{ route('lessons.show')}}`,
                    data: FormData,
                    method: "POST",
                    success: page.setLessons
                });
            }
            // rows set get
            async getRows (){
                let FormData = {
                    'lesson_id':page.lesson_id,
                }
                $.ajax({
                        url: "{{ route('rows.show') }}",
                        data: FormData,
                        method: "POST",
                        success: (res) => {
                            page.rows = res

                            $('tr[id!="adder"]').remove();
                            page.rows.map((value) => {
                                $("#adder").before(
                                `<tr id=${value.id}><td>${value.id}</td></tr>`)
                            })
                        }  
                });
            }
            //posts set get 
            getPosts (){
                for(let row of page.rows){
                    let FormData = {
                    'row_id':row.id,
                }
                $.ajax({
                        url: "{{ route('posts.show') }}",
                        data: FormData,
                        method: "POST",
                        success: page.setPosts()
                    });
                }
            }
            setPosts = (res) => {page.rows[row.id].post = res;}
            //course creator
            courseFirstOrCreate() {
                let FormData = {
                    title: $('#titleCourse').val(),
                    _token: this.token,
                }
        
                $.ajax({
                    url: "{{ route('courses.store') }}",
                    data: FormData,
                    method: "POST",
                    success: (res) => {
                        page.course_id = res.id;
                        page.getLessons();
                    }
                });
            }
            //lesson creator
            lessonsFirstOrCreate() {
                let FormData = {
                    title: $('#titleLesson').val(),
                    course_id: page.course_id,
                    _token: this.token
                }
                console.log(FormData);
        
                $.ajax({
                    url: "{{ route('lessons.store') }}",
                    data: FormData,
                    method: "POST",
                    success: async (res) => {
                        page.lesson_id = res.id;

                        page.getLessons();
                        await page.getRows()

                        
                        
                        
                        
                    }
                });
            }
        
            //row cerator
            rowFirsOrCreate() {
                let FormData = {
                    lesson_id: page.lesson_id,
                    _token: this.token,
                }
                $.ajax({
                    url: "{{ route('rows.store') }}",
                    data: FormData,
                    method: "POST",
                    success: (res) => {
                        page.postsCreate()

                        page.rows.push();
                    }
                });
            }
            
        
            //post creator
            postsCreate(){
                for (let obj of this.PostButtons) {
                    const bd = $(`<tr id='row_${res.id}'>
                                    <td class="left">  <button class="addText">Text</button>  </td> 
                                    <td class="right"> + </td> 
                                    </tr>`);
                    $('#adder').before(bd);
        
                    $(bd.children().children()[0]).on('click', (e) => {
        
                        let FormData = {
                            _token: this.token,
                            row_id: $(e.target).parent().parent().attr('id').split('_')[1],
                            col: $(e.target).parent().attr('class') == "left" ? 1 : 2
                        }
            
                        $.ajax({
                            url: `${obj.url}`,
                            data: FormData,
                            method: "POST",
                            success: (res) => {
                                $(e.target).parent().html(res[0]);
                                page.post.text = res[1];
                            }
                        });
                    })
                }
            }
        
                
        }
        const page = new pageData();
        page.course_id = 1;
        page.lesson_id = 1;

    $(document).ready(() => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
        
        
        
        
        // Course Form
        $('#subCourse').click((event) => {
            page.courseFirstOrCreate();
            event.preventDefault();
        });
        
        // Lesson Form
        
        $('#subLes').click(() => {
            page.lessonsFirstOrCreate();
            event.preventDefault();
        });
        
        //Row add
        $('#AddRow').click(page.rowFirsOrCreate())
        
        
        //post text add
        
                            });
            </script>
    @endsection    