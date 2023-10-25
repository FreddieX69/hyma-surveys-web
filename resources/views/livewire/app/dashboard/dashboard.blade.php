<div>
    <div class="page-heading">
        <h3>Tablero</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body px-4">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldUser1"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pacientes</h6>
                                        <h6 class="font-extrabold mb-0">{{ $this->patients->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body px-4">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Niños</h6>
                                        <h6 class="font-extrabold mb-0">{{ $this->patients->where('type', 2)->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body px-4">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Adultos</h6>
                                        <h6 class="font-extrabold mb-0">{{ $this->patients->where('type', 1)->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body px-4">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Estudios realizados</h6>
                                        <h6 class="font-extrabold mb-0">{{ $this->socialEconomicStudies->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Último paciente</h6>
                                        <h6 class="font-extrabold mb-0">{{ \App\Models\Patient::orderBy('id', 'DESC')->first()->name }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <x-inputs.select
                                    label="Formulario"
                                    wire:model.live="form_id"
                                    wire:change="updateFields"
                                    name="form">
                                    @foreach($this->forms as $form)
                                        <option value="{{ $form->id }}">{{ $form->description }}</option>
                                    @endforeach
                                </x-inputs.select>
                            </div>
                            <div class="col-lg-3">
                                <x-inputs.select
                                    label="Filtros disponibles"
                                    wire:model="field_id"
                                    wire:change="fillCharts(null)"
                                    name="field_id">
                                    @foreach($this->fields as $field)
                                        <option value="{{ $field->id }}">{{ $field->description }}</option>
                                    @endforeach
                                </x-inputs.select>
                            </div>
                            <div class="col-lg-3">
                                <x-inputs.date
                                    label="Fecha inicial"
                                    wire:model.live="begin_date"
                                    name="begin_date">
                                    @foreach($this->fields as $field)
                                        <option value="{{ $field->id }}">{{ $field->description }}</option>
                                    @endforeach
                                </x-inputs.date>
                            </div>
                            <div class="col-lg-3">
                                <x-inputs.date
                                    label="Fecha final"
                                    wire:model.live="end_date"
                                    name="end_date">
                                </x-inputs.date>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $charts_title }}</h4>
                            </div>
                            <div class="card-body"  wire:ignore>
                                <div id="chart-bar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $charts_title }}</h4>
                            </div>
                            <div class="card-body"  wire:ignore>
                                <div id="chart-circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@push('scripts')
    <script src="/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script>
        let chartBar
        let chartCircle
        Livewire.on('update-charts', (data) => {
            if (chartBar && chartCircle) {
                chartBar.destroy()
                chartCircle.destroy()
            }
            let optionsChartBar = {
                annotations: {
                    position: 'back'
                },
                dataLabels: {
                    enabled:true
                },
                chart: {
                    type: 'bar',
                    height: 300
                },
                fill: {
                    opacity:1
                },
                series: [{
                    name: 'Respuestas',
                    data: JSON.parse(data.values)
                }],
                colors: '#435ebe',
                xaxis: {
                    categories: JSON.parse(data.labels),
                },
            }
            let optionsChartCircle  = {
                series: JSON.parse(data.values),
                labels: JSON.parse(data.labels),
                chart: {
                    type: 'donut',
                    width: '100%',
                    height:'350px'
                },
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '30%'
                        }
                    }
                }
            }

            chartBar = new ApexCharts(document.querySelector("#chart-bar"), optionsChartBar);
            chartCircle  = new ApexCharts(document.querySelector("#chart-circle"), optionsChartCircle);
            chartBar.render();
            chartCircle.render();

        })
    </script>
@endpush
