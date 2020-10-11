<template>
    <div>
        <el-form ref="form" :model="form" label-width="120px">
            <el-form-item label="Name">
                <el-input v-model="form.name" placeholder="Enter part of name or leave blank for any"></el-input>
            </el-form-item>
            <el-form-item label="Price">
                <el-col :span="11">
                    <el-input v-model="form.price_min" placeholder="Min. price or leave blank for any"></el-input>
                </el-col>
                <el-col class="line" :span="2">-</el-col>
                <el-col :span="11">
                    <el-input v-model="form.price_max" placeholder="Max. price or leave blank for any"></el-input>
                </el-col>
            </el-form-item>
            <el-form-item label="Bedrooms">
                <el-input v-model="form.bedrooms" placeholder="Desired no. of bedrooms or leave blank for any"></el-input>
            </el-form-item>
            <el-form-item label="Bathrooms">
                <el-input v-model="form.bathrooms" placeholder="Desired no. of bathrooms or leave blank for any"></el-input>
            </el-form-item>
            <el-form-item label="Storeys">
                <el-input v-model="form.storeys" placeholder="Desired no. of storeys or leave blank for any"></el-input>
            </el-form-item>
            <el-form-item label="Garages">
                <el-input v-model="form.garages" placeholder="Desired no. of garages or leave blank for any"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSearch">Find</el-button>
            </el-form-item>
        </el-form>
        <el-table :data="found" empty-text="Nothing found">
            <el-table-column prop="name" label="Name"></el-table-column>
            <el-table-column prop="price" label="Price">
                <template slot-scope="scope">
                    {{ formatPrice(scope.row.price) }}
                </template>
            </el-table-column>
            <el-table-column prop="bedrooms" label="Bedrooms"></el-table-column>
            <el-table-column prop="bathrooms" label="Bathrooms"></el-table-column>
            <el-table-column prop="storeys" label="Storeys"></el-table-column>
            <el-table-column prop="garages" label="Garages"></el-table-column>
        </el-table>
    </div>
</template>
<script>
import axios from 'axios';

const numeral = require('numeral');

export default {
    data() {
        return {
            form:  {
                name:      '',
                price_min: '',
                price_max: '',
                bedrooms:  '',
                bathrooms: '',
                storeys:   '',
                garages:   ''
            },
            found: []
        }
    },
    methods: {
        formatPrice(price) {
            return numeral(price).format('$0,0.00')
        },
        onSearch() {
            axios.post('/dynamic/search', {
                name:      this.form.name,
                price_min: this.form.price_min,
                price_max: this.form.price_max,
                bedrooms:  this.form.bedrooms,
                bathrooms: this.form.bathrooms,
                storeys:   this.form.storeys,
                garages:   this.form.garages
            }).then(response => {
                console.log(response.status)
                console.log(response.data)
                this.found = response.data
                console.log(numeral(100).format('$0,0.00'))
            });
        }
    }
}
</script>
