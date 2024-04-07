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
                <form action="{{ route('admin.products.update', ['product' => $registro->t04id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                @else
                <form action="{{ route('admin.products.store') }}" method="POST">
                @endif

                    @csrf

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="t04slug">Slug SEO</label>
                            <input id="t04slug" name="t04slug" class="form-control" value="{{ $registro->t04slug }}" ></input>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="t04categoria">Categoría</label>
                            <select id="t04categoria" name="t04categoria" class="form-control">
                                @foreach($categoria as $id => $nombre)
                                    <option value="{{ $id }}" {{ $id == $registro->t04categoria ? 'selected' : '' }}>{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="t04nombre">Nombre/Título</label>
                            <input type="text" id="t04nombre" name="t04nombre" class="form-control" value="{{ $registro->t04nombre }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="t04presentacion">Presentacion del Producto</label>
                            <input type="text" id="t04presentacion" name="t04presentacion" class="form-control" value="{{ $registro->t04presentacion }}" required>
                        </div>
                        <div class="col-md-2">
                            <label for="t04cantidad">Cant</label>
                            <input type="text" id="t04cantidad" name="t04cantidad" class="form-control" value="{{ $registro->t04cantidad }}">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="t04tipo">Selecciona un tipo:</label>
                            <select class="form-control" id="t04tipo" name="t04tipo">
                                <option value="">Seleccionar...</option>
                                <option value="Premium" {{ $registro->t04tipo == 'Premium' ? 'selected' : '' }}>Premiun</option>
                                <option value="Delux" {{ $registro->t04tipo == 'Delux' ? 'selected' : '' }}>Delux</option>
                                <option value="Exclusive" {{ $registro->t04tipo == 'Exclusive' ? 'selected' : '' }}>Exclusivo</option>
                                <option value="Imperdible" {{ $registro->t04tipo == 'Imperdible' ? 'selected' : '' }}>Imperdible</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="t04precio">Precio de Venta</label>
                            <input type="text" id="t04precio" name="t04precio" class="form-control" value="{{ $registro->t04precio }}">
                        </div>

                        <div class="col-md-4">
                            <label>Activo</label><br>
                            <input id="Activo" name="t04activo" type="radio" value="0" {{ $registro->t04activo === 0 ? 'checked' : '' }}> Activo<br>
                            <input id="Inactivo" name="t04activo" type="radio" value="1" {{ $registro->t04activo === 1 ? 'checked' : '' }}> Inactivo
                        </div>

                    </div>

                    <div class="row form-group">


                        <div class="col-md-4">
                            <label for="t04tags">Etiquetas</label>
                            <select id="t04tags" name="t04tags[]" class="form-control chosen-select"  multiple>
                                @foreach($tags as $tagId => $tagName)
                                <option value="{{ $tagId }}" {{ in_array($tagId, $selectedTags ?? []) ? 'selected' : '' }}>
                                    {{ $tagName }}
                                </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="t04sabores">Sabores</label>
                            <select id="t04sabores" name="t04sabores[]" class="form-control chosen-select"  multiple>
                                @foreach($sabores as $saborId => $saboresName)
                                    <option value="{{ $saborId }}" {{ (in_array($saborId, $selectSabores ?? [])) ? 'selected' : '' }}>{{ $saboresName }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="t04descripcion">Descripcion del Producto</label>
                            <textarea id="t04descripcion" aclass="form-control"  name="t04descripcion">{!! $registro->t04descripcion !!}</textarea>
                        </div>
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/ckeditor.js"></script>

                    <div class="row form-group">
                        <div class="col-md-12 text-center">
                            <a href="{!! url('admin/products') !!}" class="btn btn-warning"><i class="fa fa-reply"></i> Cancelar</a>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/translations/es.js"></script>
<script>
    // This sample still does not showcase all CKEditor&nbsp;5 features (!)
    // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
    CKEDITOR.ClassicEditor.create(document.getElementById("t04descripcion"), {
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
    $("#t04nombre").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '#t04slug',
        space: '-'
    });

    $("#guardar").click(function(){
        $("#btnSubmit").click();
    });
    $('.chosen-select').chosen();
});
</script>
@stop
