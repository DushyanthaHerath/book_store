<template>
    <v-app id="keep">
        <v-app-bar
                app
                clipped-left
                color="red"
        >
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <span class="title ml-3 mr-5">Book&nbsp;<span class="font-weight-light">Store</span></span>
            <v-text-field
                    solo-inverted
                    flat
                    hide-details
                    label="Search"
                    prepend-inner-icon="search"
            ></v-text-field>

            <v-spacer></v-spacer>
        </v-app-bar>

        <navigation></navigation>

        <v-main>
            <v-container
                    fluid
                    class="grey lighten-4 fill-height flex-column"
            >
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
    import Navigation from './Navigation'
    export default {
        name: "App",
        components: {Navigation},
        props: {
            source: String,
        },
        data: () => ({
            drawer: null,
            items: [
                { icon: 'lightbulb_outline', text: 'Account' },
                { icon: 'touch_app', text: 'Wish List' },
                { divider: true },
                { icon: 'archive', text: 'Cart' },
                { icon: 'delete', text: 'Empty Cart' },
                { divider: true },
            ],
        }),
    }
</script>

<style>
    #keep .v-navigation-drawer__border {
        display: none
    }
</style>
