@extends('layouts.app')

@section('title', 'Tech Stack')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">

            {{-- Page Header --}}
            <div class="section-header">
                <h1>Tech Stack</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="#">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">Tech Stack</div>
                </div>
            </div>

            <div class="section-body">

                {{-- Title --}}
                <h2 class="section-title">Manage Tech Stack</h2>
                <p class="section-lead">Kelola daftar teknologi yang kamu gunakan di project.</p>

                {{-- CARD --}}
                <div class="card">

                    <div class="card-header">
                        <a href="javascript:void(0)" onclick="openModal()" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i> Tambah Tech Stack
                        </a>
                    </div>

                    <div class="card-body">

                        {{-- SORT --}}
                        <div class="float-left">
                            <select class="form-control selectric" id="sort">
                                @foreach ([10, 25, 50, 100] as $opt)
                                    <option value="{{ $opt }}" {{ request('sort') == $opt ? 'selected' : '' }}>
                                        {{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SEARCH --}}
                        <div class="float-right">
                            <form>
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search"
                                        value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="clearfix mb-3"></div>

                        {{-- TABLE --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center text-white">No</th>
                                        <th class="text-white">Nama</th>
                                        <th class="text-center text-white">Icon</th>
                                        <th class="text-white">Kategori</th>
                                        <th class="text-center text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp

                                    @forelse ($techstack as $item)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $item->name }}</td>

                                            <td class="text-center">
                                                <i class="{{ $item->icon_class }} fa-2x"></i>
                                            </td>

                                            <td>{{ $item->category ?? '-' }}</td>

                                            <td class="text-center">
                                                <button class="btn btn-warning btn-sm"
                                                    onclick="editModal('{{ $item->id }}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <button class="btn btn-danger btn-sm"
                                                    onclick="deleteItem('{{ $item->id }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="float-right">
                            {{ $techstack->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection


{{-- ====================== MODAL ====================== --}}
@push('modal')
    <div class="modal fade" id="stack-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <form id="form">
                    <input type="hidden" id="id">
                    <input type="hidden" id="type">

                    <div class="modal-body">

                        {{-- Name --}}
                        <div class="form-group">
                            <label>Nama Tech</label>
                            <input type="text" id="name" class="form-control" placeholder="Contoh: Laravel">
                            <span class="text-danger error_name"></span>
                        </div>

                        {{-- Icon --}}
                        <div class="form-group">
                            <label>Icon Class</label>
                            <input type="text" id="icon_class" class="form-control" placeholder="bi bi-laravel"
                                oninput="previewIcon()">
                            <span class="text-danger error_icon_class"></span>

                            <div class="mt-2">
                                <small class="text-muted">Preview:</small>
                                <div id="iconPreview" style="font-size: 32px;"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="icon_color" class="form-label">Icon Color</label>
                            <input type="color" id="icon_color" class="form-control">
                        </div>

                        {{-- Category --}}
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" id="category" class="form-control"
                                placeholder="Framework, Bahasa, dll">
                            <span class="text-danger error_category"></span>
                        </div>



                    </div>
                </form>

                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="storeBtn">Simpan</button>
                </div>

            </div>
        </div>
    </div>
@endpush


{{-- ====================== JAVASCRIPT ====================== --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000
        });
    </script>

    <script>
        const BASE = "{{ route('tech-stack.index') }}";

        $("#sort").change(function() {
            window.location.href = BASE + "?sort=" + $(this).val();
        });

        function openModal() {
            $("#stack-modal").modal("show");
            $(".modal-title").html("Tambah Tech Stack");

            $("#type").val("create");
            $("#id").val("");
            $("#name").val("");
            $("#icon_class").val("");
            $("#category").val("");
            $("#iconPreview").html("");
        }

        function previewIcon() {
            let icon = $("#icon_class").val();
            let color = $("#icon_color").val() || "#000";
            $("#iconPreview").html(`<i class="${icon}" style="color:${color}; font-size:32px"></i>`);
        }

        $("#icon_color").on("input", previewIcon);

        $("#storeBtn").click(function() {
            let type = $("#type").val();
            let id = $("#id").val();

            let url = type === "create" ?
                "{{ route('tech-stack.store') }}" :
                `/setting/tech-stack/${id}/update`;

            $.ajax({
                url: url,
                method: type === "create" ? "POST" : "PUT",
                data: {
                    name: $("#name").val(),
                    icon_class: $("#icon_class").val(),
                    icon_color: $("#icon_color").val(),
                    category: $("#category").val(),
                    _token: "{{ csrf_token() }}"
                }
            }).done(resp => {
                if (resp.errors) {
                    Toast.fire({
                        icon: "error",
                        title: "Periksa input kamu."
                    });
                    showErrors(resp.errors);
                } else {
                    $("#stack-modal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: resp.message
                    });
                    setTimeout(() => location.reload(), 800);
                }
            });
        });

        function editModal(id) {

            $.ajax({
                url: BASE + "/" + id + "/show",
                method: "GET",
                success: function(resp) {

                    if (!resp.status) {
                        Toast.fire({
                            icon: "error",
                            title: "Data tidak ditemukan"
                        });
                        return;
                    }

                    let d = resp.data;

                    $("#id").val(d.id);
                    $("#type").val("update");

                    $("#name").val(d.name);
                    $("#icon_class").val(d.icon_class);
                    $("#icon_color").val(d.icon_color);
                    $("#category").val(d.category);

                    previewIcon();

                    $("#stack-modal").modal("show");
                },

                error() {
                    Toast.fire({
                        icon: "error",
                        title: "Gagal mengambil data."
                    });
                }
            });

        }

        function deleteItem(id) {
            Swal.fire({
                title: "Hapus?",
                text: "Data tidak dapat dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus"
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/setting/tech-stack/${id}/destroy`,
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: resp => {
                            Toast.fire({
                                icon: "success",
                                title: resp.message
                            });
                            setTimeout(() => location.reload(), 700);
                        }
                    });
                }
            });
        }
    </script>
@endpush
