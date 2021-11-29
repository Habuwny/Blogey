
    <div class="container">
      <div class="row">
        <x-card
          :link="true"
          title="Most Commented"
          subtitle="What people are currently talking about"
          :items="$mostCommented"
        />
      </div>
      <div class="row mt-4">
        <x-card
          title="Most Active Last Month"
          subtitle="Writers with most written posts"
          :items="$mostActive"
        />
      </div>
      <div class="row mt-4">
        <x-card
          title="Most Active Last Month"
          subtitle="Writers with most written posts"
          :items="$mosActiveLastMonth"
        />
      </div>
    </div>