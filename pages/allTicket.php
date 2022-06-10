<div style="display: flex; flex-direction: column; justify-content: space-between; height: 100vh">
    <div class="pendingBox  ">
        <h1>Semua Ticket</h1>
        <div class="ticketResult boxFilter">
            <form action="#">
                <div>
                    <label for="tglawal">Tanggal Awal</label>
                    <input id="tglawal" name="tglawal" type="date" required>
                </div>
                <div>
                    <label for="tglawal">Tanggal Akhir</label>
                    <input id="tglawal" name="tglawal" type="date" required>
                </div>
                <div>
                    <select name="filtertype" id="filtertype">
                        <option value="date">Urut Berdasarkan Tanggal</option>
                        <option value="sn">Urut Berdasarkan Serial Number</option>
                        <option value="status">Urut Berdasarkan Status</option>
                    </select>
                </div>
                <button type="submit"><i class="fi fi-rs-search adjusts"></i> Filter Ticket</button>
            </form>
            <div class="allresult">
                <h4>Menampilkan hasil pencarian sejumlah 20 tiket.</h4>
                <table>
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>SN Unit</td>
                            <td>Tanggal Request</td>
                            <td>Jenis Pekerjaan</td>
                            <td>Nama Perusahaan</td>
                            <td>No. Handphone</td>
                            <td>Status Ticket</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>SNA1244333</td>
                            <td>22 Juli 2022</td>
                            <td>Perbaikan Radiator</td>
                            <td>PT. Bukit Asam</td>
                            <td>08126263664</td>
                            <td>Created</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="summary.php">Kembali ke Halaman Utama</a>
        </div>
    </div>
<div>