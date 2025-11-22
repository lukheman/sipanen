@props(['id_tanaman', 'pdf'])

@if (!$pdf)
    <div class="navbar d-flex justify-content-between align-items-center mb-3">

        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <form action="{{ route('laporan.panen.pdf') }}" method="POST" id="form-pdf">
            @csrf
            <input type="hidden" name="id_tanaman" value="{{ $id_tanaman }}">
            <input type="hidden" name="chart_image" id="chart_image">
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-printer"></i> Download PDF
            </button>
        </form>

    </div>
@endif
