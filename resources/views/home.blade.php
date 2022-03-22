@extends("layouts.app")
@section("content")
<div class="home_header">
    <div class="home_header_content">
        <h1>Project Kyrie</h1>
        <h3>Tu herramienta de apoyo médico laboral ideal</h3>
        <div class="home_header_arkan_logo">
            <img src="/images/arkan_logo_v3.png" alt="Arkan Logo" class="ui image"/>
            <div class="text">A r k a n</div>
        </div>
    </div>
    <svg viewBox="0 0 3000 185.4">
        <path d="M3000,0v185.4H0V0c496.4,115.6,996.4,173.4,1500,173.4S2503.6,115.6,3000,0z"></path>
    </svg>
</div>
<br>
<div class="home_content ui container">
    <h2 class="ui horizontal divider header">
        ¿Qué es Project Kyrie?
    </h2>
    <div class="ui segment">
        <p>
            Es un servicio de Arkan App iniciado en julio de 2020, con el objetivo de brindar apoyo a los estudiantes
            y profesionistas del área de la salud para agilizar sus actividades laborales mediante una plataforma que
            les permita almacenar y organizar toda la información necesaria de sus pacientes.
        </p>
    </div>
    <h2 class="ui horizontal divider header">
        Áreas
    </h2>
    <div class="ui segment">
        <p>
            <center>
                Project Kyrie está diseñado para abordar las necesidades de distintas áreas de la salud. 
                Por el momento, estas son las que ofrecemos:
            </center>
        </p>
        <div class="ui two column stackable grid">
            <div class="row">
                <div class="column">
                    <h3>Médico general</h3>
                    <div class="ui list">
                        <div class="item">
                            <i class="right angle icon"></i>
                            <div class="content">
                                Agenda de consultas
                            </div>
                        </div>
                        <div class="item">
                            <i class="right angle icon"></i>
                            <div class="content">
                                Registro de pacientes
                            </div>
                        </div>
                        <div class="item">
                            <i class="right angle icon"></i>
                            <div class="content">
                                Expediente de cada paciente
                                <div class="list">
                                    <div class="item">
                                        <i class="right angle icon"></i>
                                        <div class="content">
                                            Datos del paciente
                                        </div>
                                    </div>
                                    <div class="item">
                                        <i class="right angle icon"></i>
                                        <div class="content">
                                            Registro de consultas
                                        </div>
                                        <div class="list">
                                            <div class="item">
                                                <i class="right angle icon"></i>
                                                <div class="content">
                                                    Reprogramar consultas
                                                </div>
                                            </div>
                                            <div class="item">
                                                <i class="right angle icon"></i>
                                                <div class="content">
                                                    Cancelar consultas
                                                </div>
                                            </div>
                                            <div class="item">
                                                <i class="right angle icon"></i>
                                                <div class="content">
                                                    Finalizar consultas
                                                </div>
                                                <div class="list">
                                                    <div class="item">
                                                        <i class="right angle icon"></i>
                                                        <div class="content">
                                                            Registrar prescripción
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <i class="right angle icon"></i>
                                                        <div class="content">
                                                            Registrar nota de evolución (puede asociarse a una nueva consulta)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <i class="right angle icon"></i>
                                        Registro de reportes clínicos
                                    </div>
                                    <div class="item">
                                        <i class="right angle icon"></i>
                                        Almacenamiento de imágenes
                                    </div>
                                    <div class="item">
                                        <i class="right angle icon"></i>
                                        Notas de evolución
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="right angle icon"></i>
                            <div class="content">
                                Reporte de estadísticas
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <h3>Odontología general/Ortodoncia</h3>
                    <div class="ui list">
                        <div class="item">
                            <i class="right angle icon"></i>
                            <div class="content">
                                Incluye funcionalidades del área <b>Médico general</b>
                            </div>
                        </div>
                        <div class="item">
                            <i class="right angle icon"></i>
                            <div class="content">
                                Odontograma
                                <div class="list">
                                    <div class="item">
                                        <i class="right angle icon"></i>
                                        <div class="content">
                                            Niño, Adulto o Mixto
                                        </div>
                                    </div>
                                    <div class="item">
                                        <i class="right angle icon"></i>
                                        <div class="content">
                                            Registro de enfermedades para las caras de los dientes
                                        </div>
                                    </div>
                                    <div class="item">
                                        <i class="right angle icon"></i>
                                        <div class="content">
                                            Registro de enfermedades para los dientes
                                        </div>
                                    </div>
                                    <div class="item">
                                        <i class="right angle icon"></i>
                                        <div class="content">
                                            Historial de registro de enfermedades
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2 class="ui horizontal divider header">
        ¡Conócelo!
    </h2>
    <div class="ui raised segment">
        <h3 class="ui header">Agenda de consultas</h3>
        <h4>
            > Ten siempre a tu alcance la fecha y hora de tus próximas consultas.
        </h4>
        <img src="/images/dashboard/1.PNG" alt="Agenda de consultas" class="ui image"/>
    </div>
    <div class="ui raised segment">
        <h3 class="ui header">Registro de pacientes</h3>
        <h4>
            > Registra a todos tus pacientes y ten su información siempre a la mano.
        </h4>
        <img src="/images/dashboard/2.PNG" alt="Registro de pacientes" class="ui image"/>
    </div>
    <div class="ui raised segment">
        <h3 class="ui header">Expediente de pacientes</h3>
        <h4>
            > Administra el expediente de cada uno de tus pacientes.
        </h4>
        <img src="/images/dashboard/3.PNG" alt="Expediente de pacientes" class="ui image"/>
    </div>
    <div class="ui raised segments">
        <div class="ui segment">
            <h3 class="ui header">Historial de consultas</h3>
            <h4>
                > Administra las consultas de tus pacientes.
            </h4>
            <img src="/images/dashboard/4.PNG" alt="Historial de consultas" class="ui image"/>
        </div>
        <div class="ui segment">
            <h4>
                > Crea prescripciones y notas de evolución al finalizar una consulta.
            </h4>
            <img src="/images/dashboard/5_1.PNG" alt="Historial de consultas" class="ui image"/><br>
            <img src="/images/dashboard/5_2.PNG" alt="Historial de consultas" class="ui image"/>
        </div>
    </div>
    <div class="ui raised segments">
        <div class="ui segment">
            <h3 class="ui header">Registros clínicos</h3>
            <h4>
                > Administra los registros clínicos de tu paciente.
            </h4>
            <img src="/images/dashboard/6.PNG" alt="Registros clínicos" class="ui image"/>
        </div>
        <div class="ui segment">
            <h4>
                > Registra registros clínicos prediseñados para tus pacientes.
            </h4>
            <img src="/images/dashboard/7.PNG" alt="Historial de consultas" class="ui image"/>
        </div>
    </div>
    <div class="ui raised segment">
        <h3 class="ui header">Imágenes</h3>
        <h4>
            > Almacena imágenes que puedan serte de utilidad en un futuro.
        </h4>
        <img src="/images/dashboard/8.PNG" alt="Imágenes" class="ui image"/>
    </div>
    <div class="ui raised segment">
        <h3 class="ui header">Notas de evolución</h3>
        <h4>
            > Consulta las notas de evolución que registraste en cada consulta de tu paciente.
        </h4>
        <img src="/images/dashboard/9.PNG" alt="Notas de evolución" class="ui image"/>
    </div>
    <div class="ui raised segments">
        <div class="ui segment">
            <h3 class="ui header">Odontograma</h3>
            <h4>
                > ¡Crea el odontograma (niño, adulto o mixto) de tu paciente!
            </h4>
            <img src="/images/dashboard/10.PNG" alt="Odontograma" class="ui image"/>
        </div>
        <div class="ui segment">
            <h4>
                > Agrega enfermedades a las caras del diente que selecciones.
            </h4>
            <img src="/images/dashboard/10_1.PNG" alt="Odontograma" class="ui image"/>
        </div>
        <div class="ui segment">
            <h4>
                > Agrega enfermedades al diente que selecciones.
            </h4>
            <img src="/images/dashboard/10_2.PNG" alt="Odontograma" class="ui image"/>
        </div>
        <div class="ui segment">
            <h4>
                > Mantén un registro de las enfermedades agregadas.
            </h4>
            <img src="/images/dashboard/10_3.PNG" alt="Odontograma" class="ui image"/>
        </div>
    </div>
    <div class="ui raised segment">
        <h3 class="ui header">Generador de registros clínicos</h3>
        <h4>
            > ¿No encuentras un registro clínico prediseñado que se ajuste a tus necesidades? ¡Créalo!
        </h4>
        <img src="/images/dashboard/11.PNG" alt="Odontograma" class="ui image"/>
    </div>
</div>
@endsection
