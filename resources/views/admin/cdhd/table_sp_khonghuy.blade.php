                            @php
                            $cdhd_hientai = $hd->CongDoanHoaDon->sortByDesc('id')->first();

                            $style = [
                                'complete' => 'label label-rouded label-success',
                                'ongoing' => 'label label-rouded label-default',
                                'open' => ''
                            ];
                            
                            @endphp
                            @foreach($congdoan as $cd)
                            <td>
                                @if($cdhd_hientai->status == 0 && $cd->id > $cdhd_hientai->congdoan_id)
                                    <span class="text-danger">Chưa đến</span>
                                @else
                                    @if($cdhd_hientai->status == 0)
                                        {{-- đã làm xong --}}
                                        @if($cd->id < $cdhd_hientai->congdoan_id)

                                        <span class="{{ $style['complete'] }}">

                                        @elseif($cd->id = $cdhd_hientai->congdoan_id)
                                        {{-- đang tại công đoạn (=: và chưa xong) --}}

                                        <span class="{{ $style['ongoing'] }}">

                                        @endif
                                    @else

                                        <span class="{{ $style['complete'] }}">

                                    @endif

                                        {{-- Lọc xử lý lại --}}
                                    @if ($cdhd_hientai->congdoan_id == $cd->id &&
                                        $cd->congdoan_id != $hd->CongDoanHoaDon->sortByDesc('congdoan_id')->first()->congdoan_id)

                                        @if($hd->PhanCong()->where('congdoan_id', $cd->id)->orderBy('id', 'desc')->first() != null && $hd->PhanCong->sortByDesc('id')->first() != null)
                                            @if($hd->PhanCong()->where('congdoan_id', $cd->id)->orderBy('id', 'desc')->first()->id != $hd->PhanCong->sortByDesc('id')->first()->id)
                                        
                                        <span class="text-danger">Chưa phân công</span>

                                            @else
                                            
                                        {{ $hd->PhanCong()->where('congdoan_id', $cd->id)->orderBy('id', 'desc')->first()->NhanVien->User->name }}

                                            @endif
                                        @else

                                        <span class="text-danger">Chưa phân công</span>

                                        @endif

                                    @else
                                        {{-- Bình thường --}}
                                        @if ($hd->PhanCong()->where('congdoan_id', $cd->id)->orderBy('id', 'desc')->first() != null)

                                        {{ $hd->PhanCong()->where('congdoan_id', $cd->id)->orderBy('id', 'desc')->first()->NhanVien->User->name }}

                                        @else

                                        <span class="text-danger">Chưa phân công</span>
                                        
                                        @endif

                                    @endif
                                        </span>
                                @endif
                            </td>
                            @endforeach