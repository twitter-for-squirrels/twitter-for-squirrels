from locust import Locust, TaskSet, task
import json
import string
import random
import pprint

class ParetoBehavior(TaskSet):
	name_chars = string.ascii_lowercase + string.ascii_uppercase + string.digits

	@task(8)
	def read(self):
		self.client.get("/api/posts")

	@task(2)
	def post(self):
		if self.locust.user != None:
			self.client.post("/api/users/" + str(self.locust.user) + "/posts",
					json.dumps({"message":"i am a squirrel"}), name="/api/users/:id/posts")

	@task(1)
	def register(self):
		if self.locust.user == None:
			name = "squirrel" + ''.join(random.choice(self.name_chars) for x in range(6))
			resp = self.client.post("/api/users", json.dumps({"username": name}))
			if resp.status_code == 201:
				self.locust.user = resp.json["id"]


class ParetoUser(Locust):
	user = None
	task_set = ParetoBehavior
	min_wait = 2000
	max_wait = 10000
