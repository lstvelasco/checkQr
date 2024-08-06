import "./bootstrap";
import "flowbite";
import ApexCharts from "apexcharts";
import Alpine from "alpinejs";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";

// import './barChart';
import.meta.glob(["../images/**"]);

window.ApexCharts = ApexCharts;

window.Alpine = Alpine;
Alpine.start();

window.FullCalendar = {
    Calendar,
    dayGridPlugin,
    timeGridPlugin,
    interactionPlugin,
};
