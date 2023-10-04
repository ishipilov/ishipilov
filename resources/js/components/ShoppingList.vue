<template>
	<div :id="id">

		<div v-if="error" class="alert alert-danger" role="alert">{{ error.data.message }}</div>

		<template v-if="waiting">
			<div class="text-center p-3">
				<i class="fa-solid fa-spinner fa-spin fa-fw fa-2xl"></i>
			</div>
		</template>

		<template v-else>
			<div class="list-group">
				<template v-for="(item, key) in indata" v-key="item.id">
					<a href="#" class="list-group-item list-group-item-action" :class="{ active: (editMode && selected == item) || (!editMode && item.active) }" @click.prevent="editMode ? select(item) : toggle(key)">{{ item.text }}</a>
				</template>
			</div>

			<div v-if="editMode" class="form-group mt-3">
				<div class="input-group">
					<input v-model="input" type="text" class="form-control form-control-lg">
					<div class="input-group-append">
						<button class="btn btn-outline-primary" type="button" @click.prevent="selected ? update() : store()">{{ selected ? 'Update' : 'Store' }}</button>
					</div>
				</div>
			</div>
		</template>

		<div class="custom-control custom-switch mx-2 mt-3">
			<input v-model="editMode" type="checkbox" class="custom-control-input" id="editModeSwitch1">
			<label class="custom-control-label" for="editModeSwitch1">Toggle edit mode</label>
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
			input: '',
			selected: null,
			editMode: false,
			waiting: false,
			error: null
		}
  },
  created: function () { this.id = this.$options.name + this._uid },
  mounted: function () {
		this.load()
	},
  methods: {
		select: function (item) {
			if (this.selected == item) {
				this.selected = null
				this.input = ''
			} else {
				this.selected = item
				this.input = item.text
			}
		},
		update: function () {
			let url_update = this.selected.urls.update
			//this.waiting = true
			let requestData = {
				headers: { 'Accept': 'application/json' },
				method: 'post',
				params: {
					api_token: this.api_token
				},
				data: {
					_method: 'PATCH',
					text: this.input
				},
				url: url_update
			}
			axios(requestData)
			.then((response) => {
				let key = this.getKeyByValue(this.indata, this.selected)
				this.$set(this.indata, key, response.data.data)
				this.selected = null
				this.input = ''
				//this.waiting = false
			}).catch((error) => {
				this.error = error.response
				//this.waiting = false
			})
		},
		toggle: function (key) {
			let item = this.indata[key]
			let url_toggle = item.urls.toggle
			//this.waiting = true
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
				//this.waiting = false
			}).catch((error) => {
				this.error = error.response
				//this.waiting = false
			})
		},
		store: function () {
			//this.waiting = true
			let requestData = {
				headers: { 'Accept': 'application/json' },
				method: 'post',
				params: {
					api_token: this.api_token
				},
				data: {
					text: this.input
				},
				url: this.url_store
			}
			axios(requestData)
			.then((response) => {
				this.indata.push(response.data.data)
				//this.waiting = false
			}).catch((error) => {
				this.error = error.response
				//this.waiting = false
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
		},
		getKeyByValue: function (obj, value) {
			return Object.keys(obj).find(key => obj[key] === value)
		}
  }
};
</script>
