@extends('layouts.app')

@section('header')
    <header class="bg-white shadow m-2 rounded-md">
        <div class="mx-auto max-w-7xl px-2 py-2 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Post Update</h1>
            </div>
            <div class="">
                <a href="{{ url()->previous() }}" class="relative inline-flex items-center justify-center p-2 px-6 py-1 overflow-hidden font-medium text-indigo-600 transition duration-300 ease-out border-2 border-gray-800 rounded-full shadow-md group">
                    <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-gray-800 group-hover:translate-x-0 ease">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M11.0002 4.58569L3.58594 11.9999L11.0002 19.4141L12.4144 17.9999L7.41436 12.9999H20.0002V10.9999H7.41436L12.4144 5.99991L11.0002 4.58569Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span
                        class="absolute flex items-center justify-center w-full h-full text-black transition-all duration-300 transform group-hover:translate-x-full ease">Back</span>
                    <span class="relative invisible">Back</span>
                </a>

            </div>

        </div>
    </header>
@endsection

{{-- @section('exited')   

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900 italic">just funn! 🐳</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600 quote">
                Footer element can be used to display a site map, followed by copyright information and social media icons.

                Additional navigation on the page includes basic support content such as links, buttons, company information, copyright and forms. The footer can be easily customized to fit your style and is responsive by default.
            </p>
        </div>
    </div>

@endsection --}}

@section('content')
    <div class="min-h-full">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 w-3/4">
            <form id="postEditForm">
                @csrf
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <input type="hidden" value="{{ $post[0]->id }}" name="editId" id="editId">
                            <div class="sm:col-span-4">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                    Title
                                </label>
                                <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2. dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" value="{{$post[0]->title ?? ''}}" autocomplete="title">
                                <span class="mt-2 text-red-600" id="titleErrorMsg"></span>

                            </div>
                            <div class="col-span-full">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                    Description
                                </label>

                                <textarea id="description" name="description" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." value="{{old('description')}}" autocomplete="description">{{ $post[0]->description ?? '' }}</textarea>
                                <span class="mt-2 text-red-600" id="descriptionErrorMsg"></span>
                            </div>

                            <div class="col-span-full">
                                <label for="editorBody" class="block text-sm font-medium leading-6 text-gray-900">
                                    Body
                                </label>
                                <div class="mt-2">
                                    <textarea id="editorBody" name="editorBody" rows="3"
                                        class="ckeditor block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{$post[0]->content ?? ''}}
                                    </textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                </div>
            </form>
        </div>
    </div>  
@endsection

@section('js-script')

<script type="text/javascript">

    $(document).ready(function() {

        $('#postEditForm').submit(function(e) {
            e.preventDefault(); 

            let editId = $("#editId").val();
            let title = $("#title").val();
            let description = $("#description").val();
            let editorBody = CKEDITOR.instances.editorBody.getData();
            // let form  = $('#postEditForm')[0]
            let formdata = new FormData();
            formdata.append('editId', editId);
            formdata.append('title', title);
            formdata.append('description', description);
            formdata.append('editorBody', editorBody);

            $("#submitBtn").prop("disabled", true);
            $.ajax({
                type: "POST",
                url: "{{route('post.edit')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formdata,
                processData:false,
                contentType:false,
                success: function( response ) {
                    if(response.success){
                        toastr.success(response.success)
                    }
                    if(response.error){
                        toastr.error(response.error)
                    }
                    $("#title").val('');
                    $("#description").text('');
                    $("#editorBody").text('');
                    $("#submitBtn").prop("disabled", false);
                },
                error: function(response) {

                    var errors = response.responseJSON.errors;

                    $.map(errors, function (elementOrValue, indexOrKey) {
                        toastr.options.progressBar = true;
                        toastr.options.closeButton = true;
                        toastr.error(elementOrValue[0]);
                    });  

                    $("#submitBtn").prop("disabled", false);

                }
                
            });
        });
    });

</script>
@endsection
