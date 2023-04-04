<template>
	<div class="card">
		<div class="card-header">
			<span>Notepad</span>
			<span v-if="waiting">&mdash; Wait...</span>
		</div>
		<div class="card-body">
			<form>
				<div class="form-group">
					<textarea v-model="input" class="form-control" id="text" name="text" rows="3" :disabled="waiting"></textarea>
				</div>
				<button v-if="selected || input" type="submit" class="btn btn-success btn-sm" :disabled="waiting" @click.prevent="save">Save</button>
				<button v-if="selected && input" type="submit" class="btn btn-primary btn-sm" :disabled="waiting" @click.prevent="store">Save as new</button>
			</form>
		</div>
		<div class="list-group list-group-flush">
			<template v-for="note in notes" v-key="note.id">
				<button type="button" class="list-group-item list-group-item-action text-truncate" :class="{ active: selected && selected.id == note.id }" :disabled="waiting" @click.prevent="select(note)">{{ note.text }}</button>
			</template>
		</div>
	</div>
</template>

<script>

export default {
  name: 'vue-notepad',
  props: {
		url: { type: String, default: "" }
  },
  data: function () {
		return {
			id: null,
			notes: [],
			selected: null,
			input: "",
			waiting: false,
			error: null
		}
  },
  created: function () { this.id = this.$options.name + this._uid },
  mounted: function () { this.load() },
  methods: {
		select: function (note) {
			if (this.selected && this.selected.id == note.id) {
				this.selected = null
				this.input = ""
			} else {
				this.selected = note
				this.input = note.text
			}
		},
		save: function () {
			if (this.selected) this.update()
			else this.store()
		},
		update: function () {
			this.waiting = true
			let url = `${this.url}/${this.selected.id}`
			let requestData = {
				headers: { 'Accept': 'application/json' },
				method: 'patch',
				url: url,
				data: {
					text: this.input
				}
			}
			axios(requestData)
			.then((response) => {
				this.waiting = false
				this.load()
			}).catch((error) => {
				this.error = error.response
				this.waiting = false
			})
		},
		store: function () {
			this.waiting = true
			let requestData = {
				headers: { 'Accept': 'application/json' },
				method: 'post',
				url: this.url,
				data: {
					text: this.input
				}
			}
			axios(requestData)
			.then((response) => {
				this.waiting = false
				this.load()
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
				url: this.url
			}
			axios(requestData)
			.then((response) => {
				this.notes = response.data.notes
				this.waiting = false
			}).catch((error) => {
				this.error = error.response
				this.waiting = false
			})
		}
  }
};
</script>
