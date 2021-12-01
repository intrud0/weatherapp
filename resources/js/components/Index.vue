<template>
    <div class="app">
        <div class="sidebar">
            <img v-bind:src="'images/weather.png'" alt="Logo" class="logo" />
            <div class="weather_info">
                <ul class="uls">
                    <li class="list"><h3 class="loc"></h3></li>
                    <li class="list"><h4 class="temp"></h4></li>
                    <li class="list"><h5 class="feels_like"></h5></li>
                </ul>
            </div>

            <p class="copyright">
                &copy; Copyright by
                <a
                    class="twitter-link"
                    target="_blank"
                    href="https://twitter.com/VermonTroyd"
                    >Vermon Troyd Orijuela</a
                >.
            </p>
        </div>

        <!-- <div id="map"></div> -->
        <gmap-map id="map" :zoom="5" :center="center">
            <gmap-marker
                :position="center"
                :draggable="true"
                :clickable="true"
                @drag="updateCoordinates"
                @dragend="getCoordinates"
            ></gmap-marker>
        </gmap-map>
    </div>
</template>

<script>
export default {
    name: "AddGoogleMap",
    data() {
        return {
            errors: {},
            center: {
                lat: 14.390798,
                lng: 120.973177,
            },
        };
    },

    mounted() {
        this.getStarter(14.390798, 120.973177);
    },

    methods: {
        updateCoordinates(location) {
            this.coordinates = {
                lat: location.latLng.lat(),
                lng: location.latLng.lng(),
            };
        },
        getStarter(lat, lng) {
            const lat1 = lat;
            const long1 = lng;

            axios
                .post("/api/getWeather", { latitude: lat1, longitude: long1 })
                .then((res) => {
                    if (res.data.cod === 200) {
                        document.querySelector(".loc").textContent =
                            res.data.name + ", " + res.data.sys.country;
                        document.querySelector(".temp").textContent =
                            res.data.main.temp + "°C";
                        document.querySelector(
                            ".feels_like"
                        ).textContent = `Feels like ${res.data.main.feels_like}°C. ${res.data.weather[0].main}. ${res.data.weather[0].description}`;
                    } else {
                        this.$toaster.error(res.data.message);
                    }
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                        if (this.errors.longitude) {
                            this.$toaster.error(this.errors.longitude[0]);
                        }
                        if (this.errors.latitude) {
                            this.$toaster.error(this.errors.latitude[0]);
                        }
                    } else {
                        this.$toaster.error(error);
                    }
                });
        },
        getCoordinates(location) {
            const lat1 = location.latLng.lat();
            const long1 = location.latLng.lng();

            axios
                .post("/api/getWeather", { latitude: lat1, longitude: long1 })
                .then((res) => {
                    console.log(res.data);
                    if (res.data.cod === 200) {
                        document.querySelector(".loc").textContent =
                            res.data.name + ", " + res.data.sys.country;
                        document.querySelector(
                            ".temp"
                        ).textContent = `${res.data.main.temp}°C`;
                        document.querySelector(
                            ".feels_like"
                        ).textContent = `Feels like ${res.data.main.feels_like}°C. ${res.data.weather[0].main}. ${res.data.weather[0].description}`;
                    } else {
                        this.$toaster.error(res.data.message);
                    }
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                        if (this.errors.longitude) {
                            this.$toaster.error(this.errors.longitude[0]);
                        }
                        if (this.errors.latitude) {
                            this.$toaster.error(this.errors.latitude[0]);
                        }
                    } else {
                        this.$toaster.error(error);
                    }
                });
        },
    },
};
</script>

<style scoped>
:root {
    --color-brand--1: #ffb545 !;
    --color-brand--2: #00c46a;

    --color-dark--1: #2d3439;
    --color-dark--2: #42484d;
    --color-light--1: #aaa;
    --color-light--2: #ececec;
    --color-light--3: rgb(214, 222, 224);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: inherit;
}

html {
    font-size: 62.5%;
    box-sizing: border-box;
}

body {
    font-family: "Manrope", sans-serif;
}

/* GENERAL */
a:link,
a:visited {
    color: var(--color-brand--1);
}

.app {
    color: #ececec;
    font-weight: 400;
    line-height: 1.6;
    height: 100vh;
    overscroll-behavior-y: none;

    background-color: #fff;
    padding: 2.5rem;

    display: flex;
}
/* SIDEBAR */
.sidebar {
    flex-basis: 35rem;
    background-color: rgb(45 52 57);
    padding: 3rem 5rem 4rem 5rem;
    display: flex;
    flex-direction: column;
}

.logo {
    height: 5.2rem;
    align-self: center;
    margin-bottom: 4rem;
}
.uls {
    list-style: none;
    height: 77vh;
    /* overflow-y: scroll;
    overflow-x: hidden; */
}

.weather_info {
    background-color: #42484d;
    border-radius: 5px;
    padding: 1.5rem 2.75rem;
    margin-bottom: 1.75rem;

    /* display: grid; */
    grid-template-columns: 1fr 1fr;
    gap: 0.5rem 2.5rem;

    /* Match height and activity boxes */
    height: 10.25rem;
    transition: all 0.5s, transform 1ms;
}

.list {
    border-left: 5px solid var(--color-brand--2);
}

.copyright {
    margin-top: auto;
    font-size: 1.3rem;
    text-align: center;
    color: var(--color-light--1);
}

.twitter-link:link,
.twitter-link:visited {
    color: var(--color-light--1);
    transition: all 0.2s;
}

.twitter-link:hover,
.twitter-link:active {
    color: var(--color-light--2);
}

/* MAP */
#map {
    flex: 1;
    height: 100%;
    background-color: var(--color-light--1);
}
</style>
