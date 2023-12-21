@extends('dashboard/app')

@section('content')
 <!-- partial -->
 <link rel="stylesheet" href="{{ asset('dashboard\template\css\cards.css') }}">
 <div class="main-panel">
     <div class="content-wrapper">
         <div class="row">
             <div class="col-sm-12">
                 <div class="home-tab">
                     <div class="row">
                         <!-- Earnings (Monthly) Card Example -->
                         <div class="col">
                             <a href="/tuanrumah" class="text-decoration-none">
                                 <div class="card mb-2">
                                     <div class="card-body d-flex align-self-center">
                                         <div class="row no-gutters align-items-center">
                                             <div class="col">
                                                 <div class="fw-bold text-black">
                                                     Total <br> Pengajuan
                                                 </div>
                                                 <div class="card-title" style="font-size: 24px">{{$jumlahSemuaLaporan}}</div>
                                             </div>
                                             <div class="col-auto">
                                                 <i class="mdi mdi-archive" style="color: #097b96"></i>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </a>
                         </div>

                         <!-- Earnings (Monthly) Card Example -->
                         <div class="col">
                             <a href="/persetujuan" class="text-decoration-none">
                                 <div class="card mb-2">
                                     <div class="card-body d-flex align-self-center">
                                         <div class="row no-gutters align-items-center">
                                             <div class="col">
                                                 <div class="fw-bold text-black">
                                                     Draft <br> Laporan
                                                 </div>
                                                 <div class="card-title" style="font-size: 24px">{{ $jumlahDraft }}</div>
                                             </div>
                                             <div class="col-auto">
                                                 <i class="mdi mdi-file-document" style="color: #097b96"></i>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </a>
                         </div>

                         <!-- Earnings (Monthly) Card Example -->
                         <div class="col">
                             <a href="/history" class="text-decoration-none">
                                 <div class="card mb-2">
                                     <div class="card-body d-flex align-self-center">
                                         <div class="row no-gutters align-items-center">
                                             <div class="col">
                                                 <div class="fw-bold text-black">
                                                     Laporan  <br>
                                                      Disetujui
                                                 </div>
                                                 <div class="card-title" style="font-size: 24px">{{ $jumlahSelesai }}</div>
                                             </div>
                                             <div class="col-auto">
                                                 <i class="mdi mdi-file-check" style="color: #097b96"></i>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </a>
                         </div>

                         <!-- Earnings (Monthly) Card Example -->
                          <div class="col">
                             <a href="/history" class="text-decoration-none">
                                 <div class="card mb-2">
                                     <div class="card-body d-flex align-self-center">
                                         <div class="row no-gutters align-items-center">
                                             <div class="col">
                                                 <div class="fw-bold text-black">
                                                     Laporan <br>
                                                     Ditolak
                                                 </div>
                                                 <div class="card-title" style="font-size: 24px">{{ $jumlahDitolak }}</div>
                                             </div>
                                             <div class="col-auto">
                                                 <i class="mdi mdi-file-excel" style="color: #097b96"></i>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </a>
                          </div>
                          <div class="container">
                              <div class="card mt-2">
                                  <div class="card-body">
                                      <table class="table text-center">
                                          <thead>
                                              <tr>
                                                  <th>No Dokumen</th>
                                                  <th>Kuartal</th>
                                                  <th>Tahun</th>
                                                  <th>Status</th>
                                                  <th>Aksi</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              @php
                                              $statuses= $statuses->slice(0, 5); // Ambil 4 data pertama
                                          @endphp
                                              @foreach ($statuses as $index => $status)
                                              @if ($status->status->id_status != 6)
                                                  <tr>
                                                      <td>{{ $status ->no_dokumen_masuk }}</td>
                                                      <td>{{ $status->kuartal }}</td>
                                                      <td>{{ $status->tahun }}</td>
                                                      @if ($status->status->id_status == 6)
                                                      <td><p class="badge badge-success">{{ $status->status->nama }}</p></td>
                                                      @elseif ($status->status->id_status == 4)
                                                      <td><p class="badge badge-danger">{{ $status->status->nama }}</p></td>
                                                      @else
                                                      <td><p class="badge badge-warning">{{ $status->status->nama }}</p></td>
                                                      @endif
                                                      <td>
                                                          <a href="{{ route('timlb3.detailPeriode', $status->id_periode_laporan) }}" class="btn" style="background-color: #097b96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Detail</a>
                                                          <!-- Tambahkan tombol hapus jika dibutuhkan -->
                                                      </td>
                                                  </tr>
                                                  @endif
                                              @endforeach
                                          </tbody>
                                      </table>
                                      <div class="text-center">
                                        <a href="/status">Lihat Selengkapnya</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                     </div>
                 </div>



                   {{-- <div class="col-lg-4 d-flex flex-column">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title card-title-dash">Type By Amount</h4>
                              </div>
                              <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                              <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title card-title-dash">Todo list</h4>
                                    <div class="add-items d-flex mb-0">
                                      <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                                      <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                                    </div>
                                  </div>
                                  <div class="list-wrapper">
                                    <ul class="todo-list todo-list-rounded">
                                      <li class="d-block">
                                        <div class="form-check w-100">
                                          <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                          </label>
                                          <div class="d-flex mt-2">
                                            <div class="ps-4 text-small me-3">24 June 2020</div>
                                            <div class="badge badge-opacity-warning me-3">Due tomorrow</div>
                                            <i class="mdi mdi-flag ms-2 flag-color"></i>
                                          </div>
                                        </div>
                                      </li>
                                      <li class="d-block">
                                        <div class="form-check w-100">
                                          <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                          </label>
                                          <div class="d-flex mt-2">
                                            <div class="ps-4 text-small me-3">23 June 2020</div>
                                            <div class="badge badge-opacity-success me-3">Done</div>
                                          </div>
                                        </div>
                                      </li>
                                      <li>
                                        <div class="form-check w-100">
                                          <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                          </label>
                                          <div class="d-flex mt-2">
                                            <div class="ps-4 text-small me-3">24 June 2020</div>
                                            <div class="badge badge-opacity-success me-3">Done</div>
                                          </div>
                                        </div>
                                      </li>
                                      <li class="border-bottom-0">
                                        <div class="form-check w-100">
                                          <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                          </label>
                                          <div class="d-flex mt-2">
                                            <div class="ps-4 text-small me-3">24 June 2020</div>
                                            <div class="badge badge-opacity-danger me-3">Expired</div>
                                          </div>
                                        </div>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                      <h4 class="card-title card-title-dash">Leave Report</h4>
                                    </div>
                                    <div>
                                      <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Month Wise </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                          <h6 class="dropdown-header">week Wise</h6>
                                          <a class="dropdown-item" href="#">Year Wise</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="mt-3">
                                    <canvas id="leaveReport"></canvas>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                      <h4 class="card-title card-title-dash">Top Performer</h4>
                                    </div>
                                  </div>
                                  <div class="mt-3">
                                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                      <div class="d-flex">
                                        <img class="img-sm rounded-10" src="/dashboard/template/images/faces/face1.jpg" alt="profile">
                                        <div class="wrapper ms-3">
                                          <p class="ms-1 mb-1 fw-bold">Brandon Washington</p>
                                          <small class="text-muted mb-0">162543</small>
                                        </div>
                                      </div>
                                      <div class="text-muted text-small">
                                        1h ago
                                      </div>
                                    </div>
                                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                      <div class="d-flex">
                                        <img class="img-sm rounded-10" src="/dashboard/template/images/faces/face2.jpg" alt="profile">
                                        <div class="wrapper ms-3">
                                          <p class="ms-1 mb-1 fw-bold">Wayne Murphy</p>
                                          <small class="text-muted mb-0">162543</small>
                                        </div>
                                      </div>
                                      <div class="text-muted text-small">
                                        1h ago
                                      </div>
                                    </div>
                                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                      <div class="d-flex">
                                        <img class="img-sm rounded-10" src="/dashboard/template/images/faces/face3.jpg" alt="profile">
                                        <div class="wrapper ms-3">
                                          <p class="ms-1 mb-1 fw-bold">Katherine Butler</p>
                                          <small class="text-muted mb-0">162543</small>
                                        </div>
                                      </div>
                                      <div class="text-muted text-small">
                                        1h ago
                                      </div>
                                    </div>
                                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                      <div class="d-flex">
                                        <img class="img-sm rounded-10" src="/dashboard/template/images/faces/face4.jpg" alt="profile">
                                        <div class="wrapper ms-3">
                                          <p class="ms-1 mb-1 fw-bold">Matthew Bailey</p>
                                          <small class="text-muted mb-0">162543</small>
                                        </div>
                                      </div>
                                      <div class="text-muted text-small">
                                        1h ago
                                      </div>
                                    </div>
                                    <div class="wrapper d-flex align-items-center justify-content-between pt-2">
                                      <div class="d-flex">
                                        <img class="img-sm rounded-10" src="/dashboard/template/images/faces/face5.jpg" alt="profile">
                                        <div class="wrapper ms-3">
                                          <p class="ms-1 mb-1 fw-bold">Rafell John</p>
                                          <small class="text-muted mb-0">Alaska, USA</small>
                                        </div>
                                      </div>
                                      <div class="text-muted text-small">
                                        1h ago
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> --}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection
