<template>
    <v-row>
        <v-col
                cols="12"
                md="2"
                v-for="book in books"
                :key="book.id"
        >
            <v-card
                    class="mx-auto my-12"
                    max-width="374"
            >
                <v-img
                        height="250"
                        :src="imagePath + book.image"
                ></v-img>
                <v-card-title><span
                        class="d-inline-block text-truncate subtitle-2 font-weight-light">{{book.name}}</span></v-card-title>
                <v-card-text>
                    <v-row
                            align="center"
                            class="mx-0"
                    >
                        <v-rating
                                :value="book.rate"
                                color="amber"
                                dense
                                half-increments
                                readonly
                                size="14"
                        ></v-rating>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                            :loading="false"
                            :disabled="false"
                            color="red"
                            class="ma-2 white--text"
                            @click="loader = 'loading3' && addToCart(book)"
                    >
                        Add to Cart
                        <v-icon right dark>mdi-cart-plus</v-icon>
                    </v-btn>
                    <v-row
                            align="center"
                            justify="end"
                    >
                        <span class="subheading mr-2">{{ book.price | price }}</span>
                    </v-row>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    export default {
        name: "Home",
        data() {
          return {
              books: [],
              imagePath: process.env.APP_URL + 'images/'
          }
        },
        methods: {
            load() {
                let self = this;
                axios.get('/api/books').then((response) => {
                    self.books = response.data.result.data;
                })
            },
            ...mapActions('cart', [
                'addToCart'
            ])
        },
        mounted() {
            console.log(this.$store);
            this.load();
        },
        filters: {
            price: function (value) {
                return '$'+value.toFixed(2);
            }
        }
    }
</script>

<style scoped>

</style>
