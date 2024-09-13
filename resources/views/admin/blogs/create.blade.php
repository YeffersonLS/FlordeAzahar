@extends('adminlte::page')

@section('title'){!! $titulo !!}
@endsection

@section('content_header')
{!! $titulo !!}
@stop

@section('content')
   @if (session('mensaje'))
    <div class="alert alert-success alert-dismissable">
        {{ session('mensaje') }}
    </div>
@endif

<div class="modal" id="modalConfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de eliminar el soporte?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                <button type="button" onclick="eliminarSoporteConfirmado();" class="btn btn-danger">Sí</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-primary">
            <div class="card-header bg-primary">
                <h4 class="m-b-0 m-t-0 text-white">Datos Básicos</h4>
            </div>
            <div class="card-body">
                @if (isset($editMode))
                <form action="{{ route('admin.blogs.update', ['blog' => $registro->t01id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                @else
                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @endif

                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="t01slug">Slug SEO</label>
                            <input id="t01slug" name="t01slug" class="form-control" value="{{ $registro->t01slug }}" ></input>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="t01categoria">Categoría</label>
                            <select id="t01categoria" name="t01categoria" class="form-control">
                                @foreach($categoria as $id => $nombre)
                                    <option value="{{ $id }}" {{ $id == $registro->t01categoria ? 'selected' : '' }}>{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="t01nombre">Nombre/Título</label>
                            <input type="text" id="t01nombre" name="t01nombre" class="form-control" value="{{ $registro->t01nombre }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="t01tituloseo">Título SEO</label>
                            <input type="text" id="t01tituloseo" name="t01tituloseo" class="form-control" value="{{ $registro->t01tituloseo }}">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="t01metadescription">Descripción SEO</label>
                            <textarea id="t01metadescription" name="t01metadescription" class="form-control" >{!! $registro->t01metadescription !!}</textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Estado del Post</label><br>
                            <input id="borrador" name="t01publicado" type="radio" value="0" {{ $registro->t01publicado === 0 ? 'checked' : '' }}> Borrador<br>
                            <input id="publicado" name="t01publicado" type="radio" value="1" {{ $registro->t01publicado === 1 ? 'checked' : '' }}> Publicado
                        </div>

                        <div class="col-md-6">
                            <label for="t01tags">Etiquetas</label>
                            <select id="t01tags" name="t01tags[]" class="form-control chosen-select"  multiple>
                                @foreach($tags as $tagId => $tagName)
                                    <option value="{{ $tagId }}">{{ $tagName }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="t01descripcion">Descripción corta en la pagina</label>
                            <textarea id="t01descripcion" name="t01descripcion" class="form-control" >{!! $registro->t01descripcion !!}</textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="t01contenido">Contenido del Post</label>
                            <textarea id="t01contenido" aclass="form-control"  name="t01contenido">{!! $registro->t01contenido !!}</textarea>
                        </div>
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/ckeditor.js"></script>


                    <div class="row form-group">
                        <div class="card-body">
                            <div class="col-md-12">
                                <label for="images">Agrega Imagen Insignia al Post</label><br>
                                <input id="images" type="file" name="images[]" accept="image/*">
                            </div>
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-12 text-center">
                            <a href="{!! url('admin/blogs') !!}" class="btn btn-warning"><i class="fa fa-reply"></i> Cancelar</a>
                            <button type="submit" id="guardar" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                            <input type="submit" id="btnSubmit" style="display: none;">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="folder" id="folder">
@stop

@section('css')
    @if (env('APP_ENV') == "local")
        <link rel="stylesheet" href="css/admin_custom.css">
    @else
        <link rel="stylesheet" href="public/css/admin_custom.css">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    @if (env('APP_ENV') == "local")
        <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    @else
        <script src="{{ asset('public/vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    @endif
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/translations/es.js"></script>
<script>
    // This sample still does not showcase all CKEditor&nbsp;5 features (!)
    // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
    CKEDITOR.ClassicEditor.create(document.getElementById("t01contenido"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                'exportPDF','exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: 'Contenido del post!',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        // The "superbuild" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'AIAssistant',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced',
            'CaseChange'
        ]
    });
</script>
<script type="text/javascript">

$(document).ready(function() {
    $("#t01tituloseo").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '#t01slug',
        space: '-'
    });

    $("#guardar").click(function(){
        $("#btnSubmit").click();
    });
    $('.chosen-select').chosen();
});
</script>
@stop
