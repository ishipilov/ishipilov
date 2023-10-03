<template>
	<div :id="id">

		<div class="list-group">
			<template v-for="(item, key) in indata" v-key="item.id">
				<a href="#" class="list-group-item list-group-item-action" :class="{ active: item.active }" @click.prevent="toggle(key)">{{ item.text }}</a>
			</template>
		</div>

  </div>
</template>

<script>

export default {
  name: 'vue-shopping_list',
  props: {
		api_token: { type: String, default: "" },
		url_index: { type: String, default: "" },
		url_store: { type: String, default: "" }
  },
  data: function () {
		return {
			id: null,
			indata: [],
			waiting: false,
			error: null
		}
  },
  created: function () { this.id = this.$options.name + this._uid },
  mounted: function () {
		this.load()
	},
  methods: {
		toggle: function (key) {
			let item = this.indata[key]
			let url_toggle = item.urls.toggle
			this.waiting = true
			let requestData = {
				headers: { 'Accept': 'application/json' },
				method: 'get',
				params: {
					api_token: this.api_token
				},
				url: url_toggle
			}
			axios(requestData)
			.then((response) => {
				this.$set(this.indata, key, response.data.data)
				this.waiting = false
			}).catch((error) => {
				this.error = error.response
				this.waiting = false
			})
		},
		load: function () {
			this.waiting = true
			let requestData = {
				headers: { 'Accept': 'application/json' },
				method: 'get',
				params: {
					api_token: this.api_token
				},
				url: this.url_index
			}
			axios(requestData)
			.then((response) => {
				this.indata = response.data.data
				this.waiting = false
			}).catch((error) => {
				this.error = error.response
				this.waiting = false
			})
		}
  }
};
</script>
