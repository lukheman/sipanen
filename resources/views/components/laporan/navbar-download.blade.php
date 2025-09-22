    @if (!$pdf)

            <!-- Navbar -->
            <div class="navbar">
                <form action="{{ route('laporan.panen.pdf') }}" method="POST" id="form-pdf">
                    @csrf
                    <input type="hidden" name="chart_image" id="chart_image">
                    <button class="download-btn" type="submit">Download PDF</button>
                </form>
            </div>

    @endif

